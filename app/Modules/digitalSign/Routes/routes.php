<?php

use Illuminate\Support\Facades\Route;
use App\Modules\digitalSign\Controllers\TestController;

/**
 * Dashboard
 */
$slug = 'test';
Route::group(['middleware' => ['web'],'namespace' => 'App\Modules\digitalSign\Controllers','prefix'=>$slug], function () use ($slug){
    Route::get('/', [TestController::class, 'index'])->name('dashboard.'.$slug.'.read');
});
/**
 * Routes of digitalSign/Floors module
 */
Route::controller(App\Modules\digitalSign\Controllers\FloorsController::class)->middleware(['web','auth'])->name('floors.')->prefix('floors')->group(function (){
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

/**
 * Routes of digitalSign/Rooms module
 */
Route::controller(App\Modules\digitalSign\Controllers\RoomsController::class)->middleware(['web','auth'])->name('rooms.')->prefix('rooms')->group(function (){
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

/**
 * Routes of digitalSign/Jadwal module
 */
Route::controller(App\Modules\digitalSign\Controllers\JadwalController::class)->middleware(['web','auth'])->name('jadwal.')->prefix('jadwal')->group(function (){
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

/**
 * Routes of digitalSign/Jabatan module
 */
Route::controller(App\Modules\digitalSign\Controllers\JabatanController::class)->middleware(['web','auth'])->name('jabatan.')->prefix('jabatan')->group(function (){
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

/**
 * Routes of digitalSign/Kehadiran module
 */
Route::controller(App\Modules\digitalSign\Controllers\KehadiranController::class)->middleware(['web','auth'])->name('kehadiran.')->prefix('kehadiran')->group(function (){
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});
