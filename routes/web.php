<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
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


Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
    Route::middleware(['auth', 'role:admin'])->controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
        Route::get('/data', 'data')->name('dashboard.data');
        Route::post('/', 'create')->name('dashboard.create');
        Route::patch('/', 'update')->name('dashboard.update');
        Route::delete('/', 'destroy')->name('dashboard.destroy');
    });
});

Route::controller(DataController::class)->group(function () {
    Route::get('/', 'index')->name('data.index');
     Route::get('/form', 'form')->name('form.index');
    Route::prefix('data')->group(function () {
        Route::get('/', 'index')->name('data.index');
        Route::get('/area/{slug}/personal', 'personal')->name('personal.index');
        Route::get('/area/{slug}', 'area')->name('area.index');
        Route::post('/area/{slug}', 'storeAddress')->name('area.store');
        Route::get('/by-city/{city}', 'filter');
    });
});

require __DIR__ . '/auth.php';
