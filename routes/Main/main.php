<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;

use App\Mail\EmailFed;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () { return view('index'); });
// Route::get('/dashboard', 'dashboard@index');
Route::post('provinces/', [MainController::class, 'province']);
Route::post('districts/', [MainController::class, 'district']);
Route::post('pn/', [MainController::class, 'datePadronNominal']);

// Route::get('enviar', function(){
//     Mail::to('meydamamani@gmail.com')->send(new EmailFed());
//     return 'Mensaje Enviado!!!';
// });

Route::get('/send', [EmailFed::class, 'index']);

Route::get('/send/enviar', [EmailFed::class, 'sendMail']);
