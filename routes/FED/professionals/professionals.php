<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FedController;
Route::get('/professionals', [FedController::class, 'indexProfesion']);
Route::post('/professionals/list', [FedController::class, 'listProfesion']);
Route::get('/professionals/print', [FedController::class, 'printProfesion']);