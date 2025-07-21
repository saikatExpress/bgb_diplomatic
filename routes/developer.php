<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dev\DeveloperController;
use App\Http\Controllers\Dev\TableController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::controller(DeveloperController::class)->group(function(){
    Route::get('/developer/index', 'index')->name('developer.index');
    Route::get('/create/developer', 'create')->name('create.developer');
    Route::post('/developer/store/' . date('Y'), 'store')->name('developer.store');
});

Route::controller(TableController::class)->group(function(){
    Route::get('/create/table', 'create')->name('create.table');
});

Route::controller(DashboardController::class)->group(function(){
    Route::get('/db/backup', 'create')->name('db.backup');
});


Route::middleware(['auth', 'checkDeveloper'])->group(function(){
    Route::get('/cache-optimize', function () {
        Artisan::call('optimize:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        return 'Cache optimized!';
    });

    Route::get('/link', function () {
        Artisan::call('storage:link');
        return 'Storage Link Successfully';
    });

    Route::get('/clear', function () {
        Artisan::call('optimize:clear');
        return 'Optimize Clear!.';
    })->name('clear');

    Route::get('/clear-cache', function () {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return "Cache is cleared";
    })->name('clear.cache');
});