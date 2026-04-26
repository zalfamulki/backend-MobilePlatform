<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user-profile', function (Request $request) {
            return $request->user();
        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    // Matkul CRUD
    Route::get('/matkuls', [AcademicController::class, 'getMatkul']);
    Route::post('/matkuls', [AcademicController::class, 'storeMatkul']);
    Route::put('/matkuls/{id}', [AcademicController::class, 'updateMatkul']);
    Route::delete('/matkuls/{id}', [AcademicController::class, 'destroyMatkul']);

    // Mahasiswa CRUD
    Route::get('/mahasiswas', [AcademicController::class, 'getMahasiswa']);
    Route::post('/mahasiswas', [AcademicController::class, 'storeMahasiswa']);
    Route::put('/mahasiswas/{id}', [AcademicController::class, 'updateMahasiswa']);
    Route::delete('/mahasiswas/{id}', [AcademicController::class, 'destroyMahasiswa']);

    // Grade CRUD
    Route::get('/grades/mahasiswa/{userId}', [AcademicController::class, 'getGradeByMahasiswa']);
    Route::post('/grades', [AcademicController::class, 'storeGrade']);
    Route::put('/grades/{id}', [AcademicController::class, 'updateGrade']);
    Route::delete('/grades/{id}', [AcademicController::class, 'destroyGrade']);
    
    Route::prefix('krs')->group(function () {
        Route::get('/schedule', [AcademicController::class, 'getSchedule']);
    });
});
