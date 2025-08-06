<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LTRController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\BOPController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterFileController;
use App\Http\Controllers\Web\PillarController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\IncidentController;
use App\Http\Controllers\Admin\BattalionController;

Route::get('/web/cache-optimize', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    return 'Cache optimized!';
});

Route::get('/web/link', function () {
    Artisan::call('storage:link');
    return 'Storage Link Successfully';
});

Route::get('/web/clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimize Clear!.';
})->name('web.clear');

Route::get('/web/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('web_clear.cache');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/migrate', function () {
    if (auth()->check()) {
        Artisan::call('migrate');
        return 'Migration completed successfully!';
    }
    abort(403, 'Unauthorized action.');
})->name('migrate');

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'index')->name('search.index');
        Route::post('/search', 'search')->name('search.action');
        Route::post('/map/form/store', 'store')->name('map_form');
    });
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::post('/dashboard/search', 'search')->name('dashboard.search');
        Route::post('/chart/search', 'chartSearch')->name('chart.form');
    });
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/ltrs', 'store')->name('ltrs.store');
        Route::post('/incidents', 'incidentStore')->name('incidents.store');
        Route::post('/action', 'actionStore')->name('action.store');
        Route::get('/map/view', 'mapView');
        Route::get('/about', 'about');
    });
});

Route::controller(PillarController::class)->group(function () {
    Route::post('/pillars', 'store')->name('pillars.store');
});
Route::controller(AjaxController::class)->group(function(){
    Route::get('/fetchsector', 'getSectorsByRegion')->name('fetchsector');
    Route::get('/fetchbattalion', 'getBattalionsBySector')->name('fetchbattalion');
    Route::get('/fetchbop', 'getBopsByCompany')->name('fetchbop');
    Route::get('/fetched/letters', 'fetchedLetter')->name('fetched.letter');
    Route::get('/delete/file/{id}', 'deleteFile')->name('delete.file');
});

Route::controller(SettingController::class)->group(function(){
    Route::get('/setting', 'create')->name('setting');
});


Route::prefix('/user')->name('user.')->group(function(){
    Route::controller(AdminController::class)->group((function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::put('/update/{user}', 'update')->name('update');
        Route::delete('/delete/{user}', 'destroy')->name('destroy');
    }));
});

Route::prefix('/region')->name('region.')->group(function(){
    Route::controller(RegionController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{region}', 'edit')->name('edit');
        Route::get('/show/{region}', 'show')->name('show');
        Route::put('/update/{region}', 'update')->name('update');
        Route::delete('/destroy/{region}', 'destroy')->name('destroy');
    });
});

Route::prefix('/sector')->name('sector.')->group(function(){
    Route::controller(SectorController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{sector}', 'edit')->name('edit');
        Route::put('/update/{sector}', 'update')->name('update');
        Route::delete('/destroy/{sector}', 'destroy')->name('destroy');
    });
});

Route::prefix('/battalion')->name('battalion.')->group(function(){
    Route::controller(BattalionController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{battalion}', 'edit')->name('edit');
        Route::put('/update/{battalion}', 'update')->name('update');
        Route::delete('/destroy/{battalion}', 'destroy')->name('destroy');
    });
});

Route::prefix('/bop')->name('bop.')->group(function(){
    Route::controller(BOPController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{bop}', 'edit')->name('edit');
        Route::put('/update/{bop}', 'update')->name('update');
        Route::delete('/destroy/{bop}', 'destroy')->name('destroy');
    });
});

Route::prefix('/incident')->name('incident.')->group(function(){
    Route::controller(IncidentController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{incident}', 'edit')->name('edit');
        Route::put('/update/{incident}', 'update')->name('update');
        Route::delete('/destroy/{incident}', 'destroy')->name('destroy');
    });
});

Route::prefix('/ltr')->name('ltr.')->group(function(){
    Route::controller(LTRController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{ltr}', 'edit')->name('edit');
        Route::put('/update/{ltr}', 'update')->name('update');
        Route::delete('/destroy/{ltr}', 'destroy')->name('destroy');
    });
});

Route::prefix('/pillar')->name('pillar.')->group(function(){
    Route::controller(PillarController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{pillar}', 'edit')->name('edit');
        Route::put('/update/{pillar}', 'update')->name('update');
        Route::delete('/destroy/{pillar}', 'destroy')->name('destroy');
    });
});


Route::controller(LetterFileController::class)->group(function(){
    Route::post('/upload-letter-file', 'upload')->name('upload-letter-file');
    Route::post('/delete-letter-file', 'delete')->name('delete-letter-file');
});

require __DIR__.'/auth.php';
