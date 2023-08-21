<?php


use App\Http\Controllers\DataSlipController;
use App\Http\Controllers\PixController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'pix'], function () {
    Route::get('/', [PixController::class, 'index']);
    Route::get('/{id}', [PixController::class, 'find']);
    Route::patch('/{id}', [PixController::class, 'update']);
    Route::post('/', [PixController::class, 'create']);
});

Route::group(['prefix' => 'dataSlip'], function () {
    Route::get('/', [DataSlipController::class, 'index']);
    Route::get('/{id}', [DataSlipController::class, 'find']);
    Route::post('/', [DataSlipController::class, 'create']);
    Route::patch('/{id}', [DataSlipController::class, 'update']);
});