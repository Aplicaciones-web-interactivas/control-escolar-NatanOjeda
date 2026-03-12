<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 

Route::get('/', function () { return view('welcome'); }); 
Route::get('/registro', function () { return view('register'); }); 
Route::post('/login', [AuthController::class, 'iniciarSesion']);
Route::post('/register', [AuthController::class, 'registrar']);
Route::post('/logout', [AuthController::class, 'cerrarSesion']);
Route::get('/inicio', [AdminController::class, 'inicio']);
Route::get('/materias', [AdminController::class, 'materias']);
Route::post('/materias', [AdminController::class, 'guardarMateria']);
Route::get('/horarios', [AdminController::class, 'horarios']);
Route::post('/horarios', [AdminController::class, 'guardarHorario']);
Route::get('/grupos', [AdminController::class, 'grupos']);
Route::post('/grupos', [AdminController::class, 'guardarGrupo']);