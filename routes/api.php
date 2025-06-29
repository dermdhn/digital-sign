<?php

use App\Modules\digitalSign\Models\Jadwal;
use App\Modules\digitalSign\Models\Kehadiran;
use App\Modules\digitalSign\Models\Lantai;
use App\Modules\digitalSign\Models\PortraitSetting;
use App\Modules\digitalSign\Models\TeksBerjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/landscape-data', function () {
    return response()->json([
        'jadwal' => Jadwal::with('ruangan.lantai')->orderBy('waktu_mulai')->get(),
        'kehadiran' => Kehadiran::all(),
        'teksBerjalan' => TeksBerjalan::orderBy('urutan')->get(),
        'pengumuman' => TeksBerjalan::orderBy('urutan')->get(),
        'lantaidanruangan' => Lantai::with(['ruangan' => function ($q) {
            $q->where('is_aktif', true)->orderBy('urutan');
        }])->where('is_aktif', true)->orderBy('urutan')->get()
    ]);
});

// route to get version of portrait template
Route::get('/portrait/version', function () {
    $template = PortraitSetting::first();
    return response()->json([
        'version' => $template ? $template->version : 'default',
    ]);
})->name('portrait.version');
