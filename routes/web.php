<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Registration routes (accessible to unauthenticated users)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login routes (accessible to unauthenticated users)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    // Routes accessible only to authenticated users
    Route::resource('subjects', SubjectController::class);
    Route::resource('enrollments', EnrollmentController::class);

    Route::get('subjects/enrollments', [SubjectController::class, 'viewEnrollments'])->name('subjects.enrollments');
});
