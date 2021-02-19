<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/pdf', [App\Http\Controllers\FichasviraController::class, 'index'])->name('pdf');

Route::get('/imprimir', [App\Http\Controllers\FichasviraController::class, 'imprimir'])->name('imprimir');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/vaccine', [App\Http\Controllers\VacineController::class, 'index'])->name('vaccine');
Route::get('/vaccine/list', [App\Http\Controllers\VacineController::class, 'getVaccine'])->name('vaccine.list');
Route::post('/vaccine', [App\Http\Controllers\VacineController::class, 'update'])->name('vaccine-profile-update');


Route::get('/allergie', [App\Http\Controllers\AllergieControler::class, 'index'])->name('allergie');
Route::post('/allergie/store', [App\Http\Controllers\AllergieControler::class, 'store'])->name('allergie-store');

Route::get('/medicalappointment', [App\Http\Controllers\MedicalAppointmentController::class, 'index'])->name('medicalappointment');
Route::post('/medicalappointment-save-cita', [App\Http\Controllers\MedicalAppointmentController::class, 'saveCita'])->name('medicalappointment-save-cita');


Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat');


Route::post('/send-message-chat',[App\Http\Controllers\ChatController::class, 'sendMessageChat'])->name('send-message-chat');
Route::get('/chat-state/{id}',[App\Http\Controllers\ChatController::class, 'getChatState'])->name('chat-state');
Route::get('/chat-state-doctor/{id}',[App\Http\Controllers\ChatController::class, 'getChatStateDoctor'])->name('chat-state-doctor');

Route::get('/register/doctor', [App\Http\Controllers\RegisterDoctorController::class, 'index'])->name('registerdoctor');
Route::post('/register/doctor', [App\Http\Controllers\RegisterDoctorController::class, 'create'])->name('register-doctor');


Route::get('main', [App\Http\Controllers\MainController::class, 'index'])->name('main');

Route::get('/chats', [App\Http\Controllers\ChatsController::class, 'index'])->name('chats');
Route::post('/create-teleconsulta', [App\Http\Controllers\ChatController::class, 'createTeleconsulta'])->name('create-teleconsulta');

Route::get('/citas', [App\Http\Controllers\CitasController::class, 'index'])->name('citas');
Route::post('/citas-update', [App\Http\Controllers\CitasController::class, 'update'])->name('citas-update');

Route::get('/cita-detalle/{id}', [App\Http\Controllers\CitasController::class, 'citaDetalle'])->name('cita-detalle');
Route::post('/cita-terminar', [App\Http\Controllers\CitasController::class, 'citaTerminar'])->name('cita-terminar');

Route::get('/teleconsultas', [App\Http\Controllers\TeleconsultasController::class, 'index'])->name('teleconsultas');

Route::post('/accept-chat',[App\Http\Controllers\ChatsController::class, 'acceptChat'])->name('accept-chat');
Route::get('/salachat/{id_chat}/{id_user}',[App\Http\Controllers\SalachatController::class, 'index'])->name('salachat');

//api
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile-update');



Route::get('/reset-password-profile',[App\Http\Controllers\ResetPasswordProfileController::class, 'index'])->name('reset-password-profile');