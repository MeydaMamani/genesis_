<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailPatient\PatientController;

Route::get('/patient', [PatientController::class, 'index']);
Route::post('/patient/kids', [PatientController::class, 'searchKids']);
Route::post('/patient/pregnant', [PatientController::class, 'searchPregnant']);
Route::post('/patient/PatientDetails', [PatientController::class, 'searchPatient']);