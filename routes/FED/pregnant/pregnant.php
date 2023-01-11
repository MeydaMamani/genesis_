<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FedController;

Route::get('/bateria', [FedController::class, 'indexBateria']);
Route::post('/bateria/list', [FedController::class, 'listBateria']);
Route::get('/bateria/print', [FedController::class, 'printBateria']);

Route::get('/tratamiento', [FedController::class, 'indexTratamiento']);
Route::post('/tratamiento/listSos', [FedController::class, 'listSospecha']);
Route::get('/tratamiento/printSos', [FedController::class, 'printSospecha']);
Route::post('/tratamiento/listTrat', [FedController::class, 'listTratamiento']);
Route::get('/tratamiento/printSos', [FedController::class, 'printSospecha']);

Route::get('/newUsers', [FedController::class, 'indexNewUsers']);
Route::post('/newUsers/list', [FedController::class, 'listNewUsers']);
Route::get('/newUsers/print', [FedController::class, 'printNewUsers']); 