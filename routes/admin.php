<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\IncidentController;
use App\Http\Controllers\Admin\PillarController;
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
});
