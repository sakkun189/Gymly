<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GymEquipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ジム設備管理
    Route::get('/gym-equipment', [GymEquipmentController::class, 'index'])->name('gym-equipment.index');
    Route::post('/gym-equipment', [GymEquipmentController::class, 'store'])->name('gym-equipment.store');
    Route::get('/gym-equipment/show', [GymEquipmentController::class, 'show'])->name('gym-equipment.show');
});

require __DIR__.'/auth.php';
