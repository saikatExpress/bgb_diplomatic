<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BattalionController;
use App\Http\Controllers\Admin\BOPController;
use App\Http\Controllers\Admin\CompanyController;
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

    Route::prefix('super/admin/user')->name('user.')->group(function(){
        Route::controller(AdminController::class)->group((function(){
            Route::get('/index', 'userIndex')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{user}', 'edit')->name('edit');
            Route::put('/update/{user}', 'update')->name('update');
            Route::delete('/delete/{user}', 'destroy')->name('destroy');
        }));
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

    Route::controller(LTRController::class)->group(function(){
        Route::get('/super/admin/ltr', 'index')->name('super_admin.ltr');
        Route::get('/super/admin/ltr/create', 'create')->name('super_admin.ltr.create');
        Route::post('/super/admin/ltr/store', 'store')->name('super_admin.ltr.store');
        Route::get('/super/admin/ltr/{ltr}/edit', 'edit')->name('super_admin.ltr.edit');
        Route::put('/super/admin/ltr/{ltr}/update', 'update')->name('super_admin.ltr.update');
        Route::delete('/super/admin/ltr/{ltr}/destroy', 'destroy')->name('super_admin.ltr.destroy');
    });

    Route::controller(RegionController::class)->group(function(){
        Route::get('/super/admin/regions', 'index')->name('super_admin.regions');
        Route::get('/super/admin/regions/create', 'create')->name('super_admin.regions.create');
        Route::post('/super/admin/regions/store', 'store')->name('super_admin.regions.store');
        Route::get('/super/admin/regions/{region}/edit', 'edit')->name('super_admin.regions.edit');
        Route::put('/super/admin/regions/{region}/update', 'update')->name('super_admin.regions.update');
        Route::delete('/super/admin/regions/{region}/destroy', 'destroy')->name('super_admin.regions.destroy');
    });

    Route::controller(SectorController::class)->group(function(){
        Route::get('/super/admin/sectors', 'index')->name('super_admin.sectors');
        Route::get('/super/admin/sectors/create', 'create')->name('super_admin.sectors.create');
        Route::post('/super/admin/sectors/store', 'store')->name('super_admin.sectors.store');
        Route::get('/super/admin/sectors/{section}/edit', 'edit')->name('super_admin.sectors.edit');
        Route::put('/super/admin/sectors/{section}/update', 'update')->name('super_admin.sectors.update');
        Route::delete('/super/admin/sectors/{section}/destroy', 'destroy')->name('super_admin.sectors.destroy');
    });

    Route::controller(BattalionController::class)->group(function(){
        Route::get('/super/admin/battalions', 'index')->name('super_admin.battalions');
        Route::get('/super/admin/battalions/create', 'create')->name('super_admin.battalions.create');
        Route::post('/super/admin/battalions/store', 'store')->name('super_admin.battalions.store');
        Route::get('/super/admin/battalions/{battalion}/edit', 'edit')->name('super_admin.battalions.edit');
        Route::put('/super/admin/battalions/{battalion}/update', 'update')->name('super_admin.battalions.update');
        Route::delete('/super/admin/battalions/{battalion}/destroy', 'destroy')->name('super_admin.battalions.destroy');
    });

    Route::controller(CompanyController::class)->group(function(){
        Route::get('/super/admin/companies', 'index')->name('super_admin.companies');
        Route::get('/super/admin/companies/create', 'create')->name('super_admin.companies.create');
        Route::post('/super/admin/companies/store', 'store')->name('super_admin.companies.store');
        Route::get('/super/admin/companies/{company}/edit', 'edit')->name('super_admin.companies.edit');
        Route::put('/super/admin/companies/{company}/update', 'update')->name('super_admin.companies.update');
        Route::delete('/super/admin/companies/{company}/destroy', 'destroy')->name('super_admin.companies.destroy');
    });

    Route::controller(BOPController::class)->group(function(){
        Route::get('/super/admin/bops', 'index')->name('super_admin.bops');
        Route::get('/super/admin/bops/create', 'create')->name('super_admin.bops.create');
        Route::post('/super/admin/bops/store', 'store')->name('super_admin.bops.store');
        Route::get('/super/admin/bops/{bop}/edit', 'edit')->name('super_admin.bops.edit');
        Route::put('/super/admin/bops/{bop}/update', 'update')->name('super_admin.bops.update');
        Route::delete('/super/admin/bops/{bop}/destroy', 'destroy')->name('super_admin.bops.destroy');
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