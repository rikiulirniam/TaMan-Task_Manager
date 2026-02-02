<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('tasks.index');
});

Route::resource('/tasks', TaskController::class)->middleware(['auth', 'verified']);
Route::patch("/tasks/{task}/update-status", [TaskController::class, 'updateStatus'])->name('tasks.updateStatus')->middleware(['auth', 'verified']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
