<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('post/{post}/delete', [PostController::class, 'delete'])
    ->name('post.delete');

Route::resource('post', PostController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
});

require __DIR__ . '/auth.php';

// Route::get('post/show/{post}', [PostController::class, 'show'])
//     ->name('post.show');

// Route::get('post/{post}/edit', [PostController::class, 'edit'])
//     ->name('post.edit');

// Route::patch('post/{post}', [PostController::class, 'update'])
//     ->name('post.update');

// Route::delete('post/{post}', [PostController::class, 'destroy'])
//     ->name('post.destroy');

// Route::post('post', [PostController::class, 'store'])
//     ->name('post.store');

// Route::get('post', [PostController::class, 'index'])
//     ->name('post.index');

// Route::get('post/create', [PostController::class, 'create']);

// Route::get('/test', [TestController::class, 'test'])
//     ->name('test');
