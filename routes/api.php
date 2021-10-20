<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiMobilController;
use App\Http\Controllers\TransaksiMotorController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\KendaraanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);

    // motor
    Route::get('motor', [MotorController::class, 'index']);
    Route::post('motor/create', [MotorController::class, 'create'])->name('motor.create');
    Route::get('motor/{id}', [MotorController::class, 'detail']);
    Route::post('penjualanmotor', [TransaksiMotorController::class, 'penjualan'])->name('motor.penjualan');
    Route::get('laporanmotor', [TransaksiMotorController::class, 'laporan_penjualan']);
    Route::get('laporanmotor/{id}', [TransaksiMotorController::class, 'detail_laporan']);

    // mobil
    Route::get('mobil', [MobilController::class, 'index']);
    Route::post('mobil/create', [MobilController::class, 'create'])->name('mobil.create');
    Route::get('mobil/{id}', [MobilController::class, 'detail']);
    Route::post('penjualanmobil', [TransaksiMobilController::class, 'penjualan'])->name('motor.penjualan');;
    Route::get('laporanmobil', [TransaksiMobilController::class, 'laporan_penjualan']);
    Route::get('laporanmobil/{id}', [TransaksiMobilController::class, 'detail_laporan']);
});
