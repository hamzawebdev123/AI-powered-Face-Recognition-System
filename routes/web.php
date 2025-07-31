<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/face-matched',[UserController::class,'index']);
Route::get('/face',[UserController::class,'face']);
Route::get('/',[UserController::class,'users']);
Route::post('/',[UserController::class,'store'])->name('users.store');
Route::post('/hk',[UserController::class,'match'])->name('users.match');
