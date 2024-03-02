<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/login', function () {return view('login');});
Route::get('/join', function () {return view('join');});
Route::get('/dashboard', [DashboardController::class, 'dashboard']);