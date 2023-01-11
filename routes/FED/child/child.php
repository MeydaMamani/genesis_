<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FedController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () { return view('index'); });
// Route::get('/dashboard', 'dashboard@index');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/premature', [FedController::class, 'index']);
Route::post('/premature/list', [FedController::class, 'listPremature']);
Route::get('/premature/print', [FedController::class, 'printPremature']);

Route::get('/tmz', [FedController::class, 'indexTmz']);
Route::post('/tmz/list', [FedController::class, 'listTmzNeonatal']);
Route::get('/tmz/print', [FedController::class, 'printTmz']);

Route::get('/supplementation', [FedController::class, 'indexSuple']);
Route::post('/supplementation/list', [FedController::class, 'listSuple']);
Route::get('/supplementation/print', [FedController::class, 'printSuple']);

Route::get('/iniOport', [FedController::class, 'indexIniOport']);
Route::post('/iniOport/list', [FedController::class, 'listIniOportuno']);
Route::get('/iniOport/print', [FedController::class, 'printIniOportuno']);

Route::get('/cred', [FedController::class, 'indexCredMes']);
Route::post('/cred/list', [FedController::class, 'listCredMes']);
Route::get('/cred/print', [FedController::class, 'printCredMes']);

Route::get('/childPackage', [FedController::class, 'indexChildPackage']);
Route::get('/childPackage/print', [FedController::class, 'printchildPackage']);