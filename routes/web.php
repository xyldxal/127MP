<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
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

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Routes accessible only to authenticated users
    Route::resource('subjects', SubjectController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::get('subjects/enrollments', [SubjectController::class, 'viewEnrollments'])->name('subjects.enrollments');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/subjects/search', [StudentController::class, 'search'])->name('student.search');
    Route::post('/student/subjects/add', [StudentController::class, 'addSubject'])->name('student.add-subject');
    Route::delete('/student/subjects/{id}/remove', [StudentController::class, 'removeSubject'])->name('student.remove-subject');
    Route::post('/student/enrollments/finalize', [StudentController::class, 'finalizeEnrollment'])->name('student.finalize-enrollment');
});

// Professor dashboard route
Route::middleware(['auth', 'role:professor'])->group(function () {
    Route::get('/professor/dashboard', [ProfessorController::class, 'dashboard'])->name('professor.dashboard');
    Route::get('/professor/create-subject', [ProfessorController::class, 'createSubject'])->name('professor.create-subject');
    Route::post('/professor/store-subject', [ProfessorController::class, 'storeSubject'])->name('professor.store-subject');
    Route::get('/professor/view-enrollments/{subject}', [ProfessorController::class, 'viewEnrollments'])->name('professor.view-enrollments');
    Route::delete('/professor/remove-student/{enrollment}', [ProfessorController::class, 'removeStudent'])->name('professor.remove-student');
});
