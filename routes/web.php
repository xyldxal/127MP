<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
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
    Route::post('/student/subjects/{id}/remove', [StudentController::class, 'removeSubject'])->name('student.remove-subject');
    Route::post('/student/enrollments/finalize', [StudentController::class, 'finalizeEnrollment'])->name('student.finalize-enrollment');
});

// Professor dashboard route
Route::middleware(['auth', 'role:professor'])->group(function () {
    Route::get('/professor/dashboard', [ProfessorController::class, 'dashboard'])->name('professor.dashboard');
    Route::get('/professor/subjects/create', [ProfessorController::class, 'createSubject'])->name('professor.subjects.create');
    Route::post('/professor/subjects/store', [ProfessorController::class, 'storeSubject'])->name('professor.subjects.store');
    Route::get('/professor/subjects/{subject}/viewEnrollments', [ProfessorController::class, 'viewEnrollments'])->name('professor.subjects.viewEnrollments');
    Route::delete('/professor/enrollments/{enrollment}/removeStudent', [ProfessorController::class, 'removeStudent'])->name('professor.subjects.removeStudent');

});
