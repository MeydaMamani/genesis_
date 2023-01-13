<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;

Route::get('/', function () { return view('index'); });
// Route::get('/dashboard', 'dashboard@index');
Route::post('provinces/', [MainController::class, 'province']);
Route::post('districts/', [MainController::class, 'district']);
Route::post('pn/', [MainController::class, 'datePadronNominal']);