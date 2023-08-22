<?php

use App\Http\Controllers\ActivationController;
use App\Http\Controllers\ClientController;
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

Route::group(['prefix' => 'clients'], function () {

    Route::post('/{cnpj}/send-code', [ActivationController::class, 'sendCode']);
    
    Route::get('/{cnpj}/registration-status', [ClientController::class, 'checkRegistration']);
    Route::get('/valida-cpf', [ClientController::class, 'validaCpf']);

    Route::post('/', [ClientController::class, 'create']);
    Route::post('/{cnpj}/address', [ClientController::class, 'createAddress']);
    Route::post('/{cnpj}/company', [ClientController::class, 'createCompany']);
    Route::post('/{cnpj}/logistic', [ClientController::class, 'createLogistic']);
    Route::post('/{cnpj}/partner', [ClientController::class, 'createPartner']);
    Route::post('/{cnpj}/documents', [ClientController::class, 'createDocuments']);

    Route::put('/{cnpj}/address', [ClientController::class, 'updateAddress']);
    Route::put('/{cnpj}/company', [ClientController::class, 'updateCompany']);
    Route::put('/{cnpj}/logistic', [ClientController::class, 'updateLogistic']);
    Route::put('/{cnpj}/partner', [ClientController::class, 'updatePartner']);
    Route::put('/{cnpj}/documents', [ClientController::class, 'updateDocuments']);

    Route::delete('/{cnpj}/address', [ClientController::class, 'deleteAddress']);
    Route::delete('/{cnpj}/company', [ClientController::class, 'deleteCompany']);
    Route::delete('/{cnpj}/logistic', [ClientController::class, 'deleteLogistic']);
    Route::delete('/{cnpj}/partner', [ClientController::class, 'deletePartner']);
    Route::delete('/{cnpj}/documents', [ClientController::class, 'deleteDocuments']);

    Route::get('/{cnpj}', [ClientController::class, 'get']);
    Route::get('/{cnpj}/address', [ClientController::class, 'getAddress']);
    Route::get('/{cnpj}/company', [ClientController::class, 'getCompany']);
    Route::get('/{cnpj}/logistic', [ClientController::class, 'getLogistic']);
    Route::get('/{cnpj}/partner', [ClientController::class, 'getPartner']);
    Route::get('/{cnpj}/documents', [ClientController::class, 'getDocuments']);

});