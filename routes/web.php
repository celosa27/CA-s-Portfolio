<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\AdminController;

Auth::routes();

// Halaman portfolio (user)
Route::get('/', [PortofolioController::class, 'index']);

// Route detail project (public)
Route::get('/projects/{id}', [PortofolioController::class, 'projectDetail']);

// Halaman admin (harus login dulu)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    // Profile
    Route::get('/profile/edit', [AdminController::class, 'editProfile']);
    Route::post('/profile/update', [AdminController::class, 'updateProfile']);

    // Skills
    Route::get('/skills', [AdminController::class, 'skills']);
    Route::post('/skills/store', [AdminController::class, 'storeSkill']);
    Route::delete('/skills/{id}', [AdminController::class, 'deleteSkill']);

    // Projects
    Route::get('/projects', [AdminController::class, 'projects']);
    Route::post('/projects/store', [AdminController::class, 'storeProject']);
    Route::delete('/projects/{id}', [AdminController::class, 'deleteProject']);

    // Project detail edit
    Route::get('/projects/{id}/edit', [AdminController::class, 'editProject']);
    Route::post('/projects/{id}/update', [AdminController::class, 'updateProject']);
    Route::post('/projects/{id}/images', [AdminController::class, 'uploadImages']);
    Route::delete('/projects/images/{imageId}', [AdminController::class, 'deleteImage']);
});