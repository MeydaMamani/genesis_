<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fed\PregnantController;

Route::get('/bateria', [PregnantController::class, 'indexBateria']);
Route::post('/bateria/list', [PregnantController::class, 'listBateria']);
Route::get('/bateria/print', [PregnantController::class, 'printBateria']);

Route::get('/tratamiento', [PregnantController::class, 'indexTratamiento']);
Route::post('/tratamiento/listSos', [PregnantController::class, 'listSospecha']);
Route::get('/tratamiento/printSos', [PregnantController::class, 'printSospecha']);
Route::post('/tratamiento/listTrat', [PregnantController::class, 'listTratamiento']);
Route::get('/tratamiento/printSos', [PregnantController::class, 'printSospecha']);

Route::get('/newUsers', [PregnantController::class, 'indexNewUsers']);
Route::post('/newUsers/list', [PregnantController::class, 'listNewUsers']);
Route::get('/newUsers/print', [PregnantController::class, 'printNewUsers']);