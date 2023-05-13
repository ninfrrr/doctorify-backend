<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SpecialistController;

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
