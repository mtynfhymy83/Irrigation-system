<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // شناسه یکتا
            $table->integer('threshold')->default(450); // آستانه رطوبت (پیش‌فرض: 450)
            $table->enum('pump_status', ['on', 'off'])->default('off'); // وضعیت پمپ (پیش‌فرض: خاموش)
            $table->timestamps(); // زمان ایجاد و به‌روزرسانی
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
