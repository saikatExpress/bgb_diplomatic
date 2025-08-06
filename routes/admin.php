<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BattalionController;
use App\Http\Controllers\Admin\BOPController;
use App\Http\Controllers\Admin\IncidentController;
use App\Http\Controllers\Admin\PillarController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SubpillarController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\LTRController;
use App\Http\Controllers\Super\UnitController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/super/admin/dashboard', 'index')->name('super_admin.dashboard');
        Route::get('/backup/database', 'backUp')->name('database.backup');
    });

    Route::prefix('/super/admin/unit')->name('unit.')->group(function(){
        Route::controller(UnitController::class)->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{unit}', 'edit')->name('edit');
            Route::put('/update/{unit}', 'update')->name('update');
            Route::delete('/destroy/{unit}', 'destroy')->name('destroy');
        });
    });



    Route::controller(TagController::class)->group(function(){
        Route::get('/super/admin/tags', 'index')->name('super_admin.tags');
        Route::get('/super/admin/tags/create', 'create')->name('super_admin.tags.create');
        Route::post('/super/admin/tags/store', 'store')->name('super_admin.tags.store');
        Route::get('/super/admin/tags/{tag}/edit', 'edit')->name('super_admin.tags.edit');
        Route::put('/super/admin/tags/{tag}/update', 'update')->name('super_admin.tags.update');
        Route::delete('/super/admin/tags/{tag}/destroy', 'destroy')->name('super_admin.tags.destroy');
    });
});
