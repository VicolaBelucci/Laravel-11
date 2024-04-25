<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Category\CategoryIndex;
use App\Livewire\Tasks\TaskIndex;
use App\Models\User;
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

    Route::get('/tasks', TaskIndex::class)->name('task.index');
    Route::get('/categories', CategoryIndex::class)->name('category.index');
});

require __DIR__.'/auth.php';
