<?php

use App\Modules\digitalSign\Models\TeksBerjalan;
use Illuminate\Support\Facades\Route;
use App\Modules\digitalSign\Controllers\TestController;
use App\Modules\digitalSign\Models\Jadwal;
use App\Modules\digitalSign\Models\Kehadiran;
use App\Modules\digitalSign\Models\Lantai;
use App\Modules\digitalSign\Models\PortraitData;
use App\Modules\digitalSign\Models\PortraitMedia;
use App\Modules\digitalSign\Models\PortraitSetting;

/**
 * Dashboard
 */
$slug = 'test';
Route::group(['middleware' => ['web'], 'namespace' => 'App\Modules\digitalSign\Controllers', 'prefix' => $slug], function () use ($slug) {
    Route::get('/', [TestController::class, 'index'])->name('dashboard.' . $slug . '.read');
});

/**
 * Routes of digitalSign/Lantai module
 */
Route::controller(App\Modules\digitalSign\Controllers\LantaiController::class)->middleware(['web', 'auth'])->name('lantai.')->prefix('lantai')->group(function () {
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

/**
 * Routes of digitalSign/Ruangan module
 */
Route::controller(App\Modules\digitalSign\Controllers\RuanganController::class)->middleware(['web', 'auth'])->name('ruangan.')->prefix('ruangan')->group(function () {
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
Route::controller(App\Modules\digitalSign\Controllers\KehadiranController::class)->middleware(['web', 'auth'])->name('kehadiran.')->prefix('kehadiran')->group(function () {
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
Route::controller(App\Modules\digitalSign\Controllers\JadwalController::class)->middleware(['web', 'auth'])->name('jadwal.')->prefix('jadwal')->group(function () {
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

Route::get('/landscape', function () {
    $jadwal = Jadwal::with('ruangan.lantai')
        ->orderBy('waktu_mulai')
        ->get();
    $kehadiran = Kehadiran::all();
    $teksBerjalan = TeksBerjalan::where('is_aktif', true)->orderBy('urutan')->get();
    $pengumuman = TeksBerjalan::orderBy('urutan')->get();
    $lantaidanruangan = Lantai::with(['ruangan' => function ($q) {
        $q->where('is_aktif', true)->orderBy('urutan');
    }])->where('is_aktif', true)->orderBy('urutan')->get();

    return view('digitalSign::digital_sign.landscape', compact('jadwal', 'kehadiran', 'teksBerjalan', 'pengumuman', 'lantaidanruangan'));
})->name('landscape');

Route::get('/portrait', function () {
    $slides = PortraitData::where('is_aktif', true)->orderBy('urutan')->get();
    $media = PortraitMedia::where('is_aktif', true)->orderBy('urutan')->get(); //

    $template = PortraitSetting::first();
    $version = $template ? $template->version : 'default';

    return view("digitalSign::digital_sign.portrait", compact('slides', 'media', 'version'));
})->name('portrait');

/**
 * Routes of digitalSign/TeksBerjalan module
 */
Route::controller(App\Modules\digitalSign\Controllers\TeksBerjalanController::class)->middleware(['web', 'auth'])->name('teks_berjalan.')->prefix('teks-berjalan')->group(function () {
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

/**
 * Routes of digitalSign/PortraitData module
 */
Route::controller(App\Modules\digitalSign\Controllers\PortraitDataController::class)->middleware(['web', 'auth'])->name('portrait_data.')->prefix('portrait-data')->group(function () {
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});


/**
 * Routes of digitalSign/PortraitMedia module
 */
Route::controller(App\Modules\digitalSign\Controllers\PortraitMediaController::class)->middleware(['web','auth'])->name('portrait_media.')->prefix('portrait-media')->group(function (){
    Route::get('/', 'index')->name('read');
    Route::post('/filter', 'filter')->name('filter.read');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});
