<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landscape', function () {
    return view('landscape');
});

Route::get('/portrait', function () {
    return view('portrait');
});

Route::get('/portrait2', function () {
    return view('portrait2');
});

Route::get('/portrait3', function () {
    return view('portrait3');
});

Route::get('/portrait4', function () {
    return view('portrait4');
});