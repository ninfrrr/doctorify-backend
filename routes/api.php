<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\SpecialistController;
use App\Http\Controllers\API\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth API
Route::name('auth.')->group(function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
        Route::get('user', [UserController::class, 'fetch'])->name('fetch');
    });
});

// Specialist API
Route::prefix('specialist')->name('specialist.')->middleware('auth:sanctum')->group(function () {
    Route::get('', [SpecialistController::class, 'fetch'])->name('fetch');
    Route::post('', [SpecialistController::class, 'create'])->name('create');
    Route::put('update/{id}', [SpecialistController::class, 'update'])->name('edit');
    Route::delete('{id}', [SpecialistController::class, 'delete'])->name('delete');
});

// Doctor API
Route::prefix('doctor')->name('doctor.')->middleware('auth:sanctum')->group(function () {
    Route::get('', [DoctorController::class, 'fetch'])->name('fetch');
    Route::post('', [DoctorController::class, 'create'])->name('create');
    Route::post('update/{id}', [DoctorController::class, 'update'])->name('edit');
    Route::delete('{id}', [DoctorController::class, 'delete'])->name('delete');
});

// Appointment API
Route::prefix('appointment')->name('appointment.')->middleware('auth:sanctum')->group(function () {
    Route::get('', [AppointmentController::class, 'fetch'])->name('fetch');
    Route::post('', [AppointmentController::class, 'create'])->name('create');
    Route::put('update/{id}', [AppointmentController::class, 'update'])->name('edit');
    Route::delete('{id}', [AppointmentController::class, 'delete'])->name('delete');
});
