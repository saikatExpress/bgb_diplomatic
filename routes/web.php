<?php

use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\PillarController;
use App\Models\LTR;

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
    });
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
    });
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/ltrs', 'store')->name('ltrs.store');
        Route::post('/incidents', 'incidentStore')->name('incidents.store');
        Route::post('/action', 'actionStore')->name('action.store');
    });
});

Route::controller(PillarController::class)->group(function () {
    Route::post('/pillars', 'store')->name('pillars.store');
    Route::post('/subpillars', 'subpillarStore')->name('subpillars.store');
    Route::get('/get/subpillars', 'getSubpillars')->name('getSubPillars');
});

Route::controller(AjaxController::class)->group(function(){
    Route::get('/fetchsector', 'getSectorsByRegion')->name('fetchsector');
    Route::get('/fetchbattalion', 'getBattalionsBySector')->name('fetchbattalion');
    Route::get('/fetchcompany', 'getCompaniesByBattalion')->name('fetchcompany');
    Route::get('/fetchbop', 'getBopsByCompany')->name('fetchbop');
});

require __DIR__.'/auth.php';