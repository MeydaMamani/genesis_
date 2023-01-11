<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FedController;
Route::get('/sisCovid', [FedController::class, 'indexSisCovid']);
Route::post('/sisCovid/list', [FedController::class, 'listSisCovid']);
Route::get('/sisCovid/print', [FedController::class, 'printSisCovid']);