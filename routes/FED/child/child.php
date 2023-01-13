<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Fed\KidsController;

Route::get('/', function () { return view('index'); });
// Route::get('/dashboard', 'dashboard@index');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/premature', [KidsController::class, 'index']);
Route::post('/premature/list', [KidsController::class, 'listPremature']);
Route::get('/premature/print', [KidsController::class, 'printPremature']);

Route::get('/tmz', [KidsController::class, 'indexTmz']);
Route::post('/tmz/list', [KidsController::class, 'listTmzNeonatal']);
Route::get('/tmz/print', [KidsController::class, 'printTmz']);

Route::get('/supplementation', [KidsController::class, 'indexSuple']);
Route::post('/supplementation/list', [KidsController::class, 'listSuple']);
Route::get('/supplementation/print', [KidsController::class, 'printSuple']);

Route::get('/iniOport', [KidsController::class, 'indexIniOport']);
Route::post('/iniOport/list', [KidsController::class, 'listIniOportuno']);
Route::get('/iniOport/print', [KidsController::class, 'printIniOportuno']);

Route::get('/cred', [KidsController::class, 'indexCredMes']);
Route::post('/cred/list', [KidsController::class, 'listCredMes']);
Route::get('/cred/print', [KidsController::class, 'printCredMes']);

Route::get('/childPackage', [KidsController::class, 'indexChildPackage']);
Route::get('/childPackage/print', [KidsController::class, 'printchildPackage']);