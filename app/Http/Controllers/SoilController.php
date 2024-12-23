<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SoilService;

class SoilController extends Controller
{
    protected $soilService;

    public function __construct(SoilService $soilService)
    {
        $this->soilService = $soilService;
    }

    // ذخیره مقدار رطوبت و تصمیم‌گیری درباره وضعیت پمپ
    public function storeMoisture(Request $request)
    {
        $request->validate([
            'moisture' => 'numeric',
        ]);

        $response = $this->soilService->storeMoisture($request->moisture);

        return response()->json($response, 201);
    }

    // بازگرداندن تنظیمات فعلی سیستم
    public function getSoilStatus()
    {
        $response = $this->soilService->getSoilStatus();

        return response()->json($response);
    }

    // به‌روزرسانی دستی وضعیت پمپ
    public function updatePumpStatus(Request $request)
    {
        $request->validate([
            'pump_status' => 'required|in:on,off',
        ]);

        $pumpStatus = $this->soilService->updatePumpStatus($request->pump_status);

        return response()->json([
            'message' => 'Pump status updated successfully.',
            'pump_status' => $pumpStatus,
        ]);
    }

    // دریافت تاریخچه رطوبت
    public function getMoistureHistory(Request $request)
    {
        $readings = $this->soilService->getMoistureHistory(10);

        return response()->json([
            'message' => 'Moisture history retrieved successfully.',
            'data' => $readings,
        ]);
    }
}
