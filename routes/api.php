<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiMotorController;
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
    Route::get('kendaraans', [KendaraanController::class, 'index']);
    Route::get('kendaraans/{id}', [KendaraanController::class, 'show']);
    Route::post('create', [KendaraanController::class, 'store']);
    Route::put('update/{kendaraan}',  [KendaraanController::class, 'update']);
    Route::delete('delete/{kendaraan}',  [KendaraanController::class, 'destroy']);

    // motor
    Route::get('motor', [MotorController::class, 'index']);
    Route::post('penjualanmotor', [TransaksiMotorController::class, 'penjualan']);
    Route::get('laporanmotor', [TransaksiMotorController::class, 'laporan_penjualan']);

    // Route::get('/motor', 'MotorController@index');
    // Route::get('/motor/{id}', 'MotorController@detail');
    // Route::post('/penjualanmotor', 'MotorController@penjualan');
    // Route::get('/laporanmotor', 'MotorController@laporan_penjualan');
    // Route::get('/detaillaporanmotor', 'MotorController@detail_laporan');

});