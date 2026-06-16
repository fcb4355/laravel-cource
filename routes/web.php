<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestroyNotesController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// Routes Pages
Route::view('/', "welcome");
Route::view('/about', "about");
Route::view('/contact', "contact");


Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'index']);
    Route::get('/notes/create', [NoteController::class, 'create']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::get('/notes/{id}', [NoteController::class, 'show'])->whereNumber('id');
    Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->whereNumber('id');
    Route::patch('/notes/{id}', [NoteController::class, 'update'])->whereNumber('id');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->whereNumber('id');

    Route::delete('/notes', DestroyNotesController::class); // Destroy All Notes.

    Route::delete('/logout', [AuthController::class, 'logout']);
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'showRegisterForm']);
    Route::post('/register', [AuthController::class, 'register']);
});


// Route::
Route::fallback(function () {
    return view('404');
});
