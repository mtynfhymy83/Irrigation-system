<?php

namespace App\Services;

use App\Models\SoilReading;
use App\Models\Setting;

class SoilService
{
    /**
     * ذخیره مقدار رطوبت و مدیریت وضعیت پمپ
     *
     * @param float $moisture
     * @return array
     */
    public function storeMoisture($moisture)
    {
        // ذخیره مقدار رطوبت
        $reading = new SoilReading();
        $reading->moisture = $moisture;
        $reading->save();

        // دریافت یا ایجاد تنظیمات
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
            $setting->threshold = 450;
            $setting->pump_status = 'off';
            $setting->save();
        }

        // تعیین وضعیت پمپ
        $pumpStatus = $moisture >= $setting->threshold ? 'on' : 'off';
        $setting->update(['pump_status' => $pumpStatus]);

        return [
            'message' => 'Moisture data stored successfully.',
            'pump_status' => $pumpStatus,
        ];
    }

    /**
     * دریافت وضعیت فعلی سیستم
     *
     * @return array
     */
    public function getSoilStatus()
    {
        $setting = Setting::first();
        $lastReading = SoilReading::orderBy('created_at', 'desc')->first();

        return [
            'threshold' => $setting->threshold ?? 450,
            'pump_status' => $setting->pump_status ?? 'off',
            'last_moisture' => $lastReading->moisture ?? null,
        ];
    }

    /**
     * به‌روزرسانی وضعیت پمپ
     *
     * @param string $pumpStatus
     * @return string
     */
    public function updatePumpStatus($pumpStatus)
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['threshold' => 450, 'pump_status' => 'off']);
        }
        $setting->update(['pump_status' => $pumpStatus]);

        return $setting->pump_status;
    }

    /**
     * دریافت تاریخچه رطوبت
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getMoistureHistory($perPage = 10)
    {
        return SoilReading::orderBy('created_at', 'desc')->paginate($perPage);
    }

}
