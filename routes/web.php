<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\SubmissionController;

Route::post('/entities/{id}/rate', [DirectoryController::class, 'rate'])->name('entities.rate')->middleware('auth');
Route::get('/', function () {
    return redirect('/login');
});
Route::post('/entities/{id}/rate', [DirectoryController::class, 'rate'])->name('entities.rate')->middleware('auth');
// Auth Routes
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard & Directory (Protected by Auth Middleware)
Route::get('/dashboard', [DirectoryController::class, 'index'])->middleware('auth');

// Submission Routes (Protected)
Route::get('/submit', [SubmissionController::class, 'create'])->middleware('auth');
Route::post('/submit', [SubmissionController::class, 'store'])->middleware('auth');

// Admin Routes (Protected for Admin Only)
Route::get('/admin/submissions', [SubmissionController::class, 'adminIndex'])->middleware('auth');
Route::post('/admin/submissions/{id}/approve', [SubmissionController::class, 'approve'])->middleware('auth');
