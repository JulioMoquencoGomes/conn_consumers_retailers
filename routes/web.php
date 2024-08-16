<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterWebsiteController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/actions', [DashboardController::class, 'actions'])->name('dashboard_actions');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/registerwebsite', [RegisterWebsiteController::class, 'index'])->name('registerwebsite');
    Route::get('/registerwebsite/delete/{id}', [RegisterWebsiteController::class, 'delete'])->name('registerwebsite_delete');

    Route::get('/registerwebsite/create', [RegisterWebsiteController::class, 'create'])->name('registerwebsite_create');
    Route::post('/registerwebsite/save', [RegisterWebsiteController::class, 'save'])->name('registerwebsite_save');

    Route::get('/registerwebsite/edit/{id}', [RegisterWebsiteController::class, 'edit'])->name('registerwebsite_edit');
    Route::post('/registerwebsite/update', [RegisterWebsiteController::class, 'update'])->name('registerwebsite_update');

    Route::get('/registerwebsite/km/{id}', [RegisterWebsiteController::class, 'km'])->name('registerwebsite_km');
    Route::get('/registerwebsite/getname/{id}', [RegisterWebsiteController::class, 'getname'])->name('registerwebsite_getname');
});

Route::middleware('auth')->group(function () {
    Route::get('/monitoring/{id?}', [MonitoringController::class, 'index'])->name('monitoring');
    Route::get('/monitoring/create', [MonitoringController::class, 'create'])->name('monitoring_create');
    
    Route::get('/monitoring/competitors/create', [MonitoringController::class, 'competitorscreate'])->name('monitoring_competitorscreate');

    Route::post('/monitoring/competitors/save', [MonitoringController::class, 'competitorssave'])->name('monitoring_competitorssave');

    Route::get('/monitoring/competitors/edit/{id}', [MonitoringController::class, 'competitorsedit'])->name('monitoring_competitorsedit');
    Route::get('/monitoring/competitors/delete/{id}', [MonitoringController::class, 'competitorsdelete'])->name('monitoring_competitorsdelete');

    Route::post('/monitoring/competitors/update', [MonitoringController::class, 'competitorsupdate'])->name('monitoring_competitorsupdate');
});

require __DIR__.'/auth.php';
