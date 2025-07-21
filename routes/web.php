<?php

use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterFileController;
use App\Http\Controllers\Web\PillarController;

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
    Route::get('/fetchcompany', 'getCompaniesByBattalion')->name('fetchcompany');
    Route::get('/fetchbop', 'getBopsByCompany')->name('fetchbop');
    Route::get('/fetched/letters', 'fetchedLetter')->name('fetched.letter');
    Route::get('/delete/file/{id}', 'deleteFile')->name('delete.file');
});

Route::controller(LetterFileController::class)->group(function(){
    Route::post('/upload-letter-file', 'upload')->name('upload-letter-file');
    Route::post('/delete-letter-file', 'delete')->name('delete-letter-file');
});

require __DIR__.'/auth.php';