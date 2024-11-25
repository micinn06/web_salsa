<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\UserController;

Route::post('/register', [UserController::class, 'register']); // Registrasi
Route::post('/login', [UserController::class, 'login']);       // Login

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']); // Logout

// Route API Resources
Route::apiResource('agendas', AgendaController::class);
Route::apiResource('comment', CommentController::class);
Route::apiResource('galleries', GalleryController::class);
Route::apiResource('photos', PhotoController::class);
Route::apiResource('infos', InfoController::class);
Route::apiResource('users', UserController::class);

// Route yang memerlukan autentikasi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/check-email', [UserController::class, 'checkEmail']);
    Route::get('/galleries/{gallery}/photos', [PhotoController::class, 'getPhotosByGallery']);
});