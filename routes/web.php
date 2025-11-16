<?php

use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('finance', [FinanceController::class, 'store'])->name('finance.store');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
