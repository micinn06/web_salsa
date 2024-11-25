<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    GalleryController,
    PhotoController,
    InfoController,
    AgendaController,
    UserController,
    Admin\DashboardController,
    CommentController
};

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/gallery', [GalleryController::class, 'userindex'])->name('gallery.index');
    Route::get('/gallery/{gallery}/photos', [GalleryController::class, 'usershow'])->name('gallery.show');
    Route::get('/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::get('/agenda', [AgendaController::class, 'userindex'])->name('agenda.index');
    Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show'); // Rute baru untuk show agenda
    Route::get('/info', [InfoController::class, 'userindex'])->name('info.index');
    Route::get('/info/{id}', [InfoController::class, 'show'])->name('info.show'); // Rute baru untuk show info
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginStore'])->name('login.store');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerStore'])->name('register.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('galleries', GalleryController::class);
    Route::resource('photos', PhotoController::class);
    Route::resource('users', UserController::class);
    Route::resource('photos', PhotoController::class)->except(['show']);
    Route::resource('infos', InfoController::class); 
    Route::resource('agendas', AgendaController::class);
});


Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('photos.show');
Route::post('/photos/{id}/comments', [PhotoController::class, 'storeComment'])->name('photos.comment.store');


Route::get('photos/{photo}/edit', [PhotoController::class, 'edit'])->name('dashboard.photos.edit');
Route::put('photos/{photo}', [PhotoController::class, 'update'])->name('dashboard.photos.update');
Route::delete('photos/{photo}', [PhotoController::class, 'destroy'])->name('dashboard.photos.destroy');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
