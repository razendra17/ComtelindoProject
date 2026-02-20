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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
    Route::middleware(['auth', 'role:admin'])->controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
        Route::post('/', 'create')->name('dashboard.create');
        Route::patch('/', 'update')->name('dashboard.update');
        Route::delete('/', 'destroy')->name('dashboard.destroy');
    });
});

Route::controller(DataController::class)->prefix('forms')->group(function(){
    Route::post('/', 'create')->name('form.create'); 
});

require __DIR__ . '/auth.php';
