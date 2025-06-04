<?php

use App\Http\Controllers\Dev\DeveloperController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::controller(DeveloperController::class)->group(function(){
    Route::get('/developer/' . date('Y'), 'store')->name('developer.store');
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