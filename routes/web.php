<?php

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

use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultaController;


Route::get('/especialidade', [EspecialidadeController::class, 'index']);
Route::get('/especialidade/create', [EspecialidadeController::class, 'create']);
Route::post('/especialidade', [EspecialidadeController::class, 'store']);
Route::get('/especialidade/edit/{id}', [EspecialidadeController::class, 'edit']);
Route::put('/especialidade/update/{id}', [EspecialidadeController::class, 'update']);

Route::get('/profissional', [DoctorController::class, 'index']);
Route::get('/profissional/create', [DoctorController::class, 'create']);
Route::post('/profissional', [DoctorController::class, 'store']);
Route::get('/profissional/edit/{id}', [DoctorController::class, 'edit']);
Route::put('/profissional/update/{id}', [DoctorController::class, 'update']);
Route::get('/profissional/{patient_id}', [DoctorController::class, 'getDoctorByAgePatient']);

Route::get('/pacientes', [PatientController::class, 'index']);
Route::get('/pacientes/create', [PatientController::class, 'create']);
Route::post('/pacientes', [PatientController::class, 'store']);
Route::get('/pacientes/edit/{id}', [PatientController::class, 'edit']);
Route::put('/pacientes/update/{id}', [PatientController::class, 'update']);

Route::get('/consulta/create', [ConsultaController::class, 'create']);
Route::post('/consulta', [ConsultaController::class, 'store']);
Route::get('/', [ConsultaController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });
