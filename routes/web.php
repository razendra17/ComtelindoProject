<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controller::class, 'home'])->name('home.index');

//Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });
    Route::controller(PackageController::class)->prefix('package')->group(function () {
        Route::get('/add', 'indexPackage')->name('package.index');
        Route::post('/add', 'storePackage')->name('package.store');
    });
    Route::controller(CityController::class)->prefix('city')->group(function () {
        Route::get('/add', 'indexCity')->name('city.index');
        Route::post('/add', 'storeCity')->name('city.store');
    });
    Route::controller(DataController::class)->prefix('data')->group(function () {
        Route::get('/', 'index')->name('dataadmin.index');
        Route::get('/datas', 'indexTables')->name('dashboard.data');
        Route::put('/{id}/approve', 'approve');
        Route::put('/{id}/reject', 'reject')->name('rejection');
        Route::delete('/{id}', 'destroy');
        Route::get('/details/{slug}', 'details')->name('details.index');
    });
});

// Users routes
Route::controller(DataController::class)->prefix('user')->group(function () {
    Route::get('/redirect', 'redirect')->name('redirect.index');
    Route::get('/data', 'userIndex')->name('data.index');
    Route::get('/area/{slug}/personal', 'personalForms')->name('personal.index');
    Route::post('/area/{slug}/personal', 'dataStore')->name('personal.store');
    Route::get('/area/{slug}', 'area')->name('area.index');
    Route::post('/area/{slug}', 'storeAddress')->name('area.store');
    Route::get('/by-city/{city}', 'filter');
});

require __DIR__ . '/auth.php';
