<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::resource('enrollments', EnrollmentController::class);

    Route::get('subjects/enrollments', [SubjectController::class, 'viewEnrollments'])->name('subjects.enrollments');

});