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