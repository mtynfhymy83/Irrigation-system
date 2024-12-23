<?php
use App\Http\Controllers\SoilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Kernel;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::middleware('auth:sanctum')->get('/get-user-info', function (Request $request) {

    });


        Route::post('soil-data', [SoilController::class, 'storeMoisture']);
        Route::get('soil-status', [SoilController::class, 'getSoilStatus']);
        Route::post('pump-status', [SoilController::class, 'updatePumpStatus']);
        Route::post('last-status', [SoilController::class, 'getMoistureHistory']);

});

