<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('projects', App\Http\Controllers\ProjectController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
