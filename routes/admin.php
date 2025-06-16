<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\IncidentController;
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
});