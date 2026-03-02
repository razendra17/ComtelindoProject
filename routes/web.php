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

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
            Route::prefix('data')->group(function () {
                Route::get('/', 'dataIndex')->name('dataAdmin.index');
                Route::get('/datas', 'data')->name('dashboard.data');
                Route::put('/{id}/approve', 'approve');
                Route::put('/{id}/reject', 'reject');
                Route::delete('/{id}', 'destroy');
                Route::get('/details/{slug}', 'details')->name('details.index');
            });
        });
        Route::controller(PackageController::class)->prefix('package')->group(function () {
            Route::get('/add/package', 'indexPackage')->name('package.index');
            Route::post('/add/package', 'storePackage')->name('package.store');
        });
        Route::controller(CityController::class)->prefix('city')->group(function () {
            Route::get('/add/city', 'indexCity')->name('city.index');
            Route::post('/add/city', 'storeCity')->name('city.store');
        });
    });
});

Route::controller(DataController::class)->group(function () {
    Route::get('/form', 'form')->name('form.index');
    Route::prefix('data')->group(function () {
        Route::get('/', 'index')->name('data.index');
        Route::get('/area/{slug}/personal', 'personal')->name('personal.index');
        Route::post('/area/{slug}/personal', 'packageStore')->name('personal.store');
        Route::get('/area/{slug}', 'area')->name('area.index');
        Route::post('/area/{slug}', 'storeAddress')->name('area.store');
        Route::get('/by-city/{city}', 'filter');
    });
});

require __DIR__ . '/auth.php';
