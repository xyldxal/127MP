<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::resource('enrollments', EnrollmentController::class);

    Route::get('subjects/enrollments', [SubjectController::class, 'viewEnrollments'])->name('subjects.enrollments');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

});