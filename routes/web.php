<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ActivityLogController::class, 'index'])->name('dashboard');
    Route::post('/activities', [ActivityLogController::class, 'store'])->name('activities.store');
    Route::patch('/activities/{activityLog}', [ActivityLogController::class, 'update'])->name('activities.update');
    Route::put('/activities/{activity}', [ActivityLogController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{activity}', [ActivityLogController::class, 'destroy'])->name('activities.destroy');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/activities/export', [ActivityLogController::class, 'exportCsv'])->name('activities.export');

require __DIR__.'/auth.php';
