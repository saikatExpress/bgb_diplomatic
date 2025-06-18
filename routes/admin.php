<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\IncidentController;
use App\Http\Controllers\Admin\PillarController;
use App\Http\Controllers\LTRController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/super/admin/dashboard', 'index')->name('super_admin.dashboard');
    });

    Route::controller(IncidentController::class)->group(function(){
        Route::get('/super/admin/incidents', 'index')->name('super_admin.incidents');
        Route::get('/super/admin/incidents/create', 'create')->name('super_admin.incidents.create');
        Route::post('/super/admin/incidents/store', 'store')->name('super_admin.incidents.store');
        Route::get('/super/admin/incidents/{incident}/edit', 'edit')->name('super_admin.incidents.edit');
        Route::put('/super/admin/incidents/{incident}/update', 'update')->name('super_admin.incidents.update');
        Route::delete('/super/admin/incidents/{incident}/destroy', 'destroy')->name('super_admin.incidents.destroy');
    });

    Route::controller(PillarController::class)->group(function(){
        Route::get('/super/admin/pillars', 'index')->name('super_admin.pillars');
        Route::get('/super/admin/pillars/create', 'create')->name('super_admin.pillars.create');
        Route::post('/super/admin/pillars/store', 'store')->name('super_admin.pillars.store');
        Route::get('/super/admin/pillars/{pillar}/edit', 'edit')->name('super_admin.pillars.edit');
        Route::put('/super/admin/pillars/{pillar}/update', 'update')->name('super_admin.pillars.update');
        Route::delete('/super/admin/pillars/{pillar}/destroy', 'destroy')->name('super_admin.pillars.destroy');
    });

    Route::controller(LTRController::class)->group(function(){
        Route::get('/super/admin/ltr', 'index')->name('super_admin.ltr');
        Route::get('/super/admin/ltr/create', 'create')->name('super_admin.ltr.create');
        Route::post('/super/admin/ltr/store', 'store')->name('super_admin.ltr.store');
        Route::get('/super/admin/ltr/{ltr}/edit', 'edit')->name('super_admin.ltr.edit');
        Route::put('/super/admin/ltr/{ltr}/update', 'update')->name('super_admin.ltr.update');
        Route::delete('/super/admin/ltr/{ltr}/destroy', 'destroy')->name('super_admin.ltr.destroy');
    });
});