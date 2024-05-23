<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', [BoardController::class, 'index'])->name('boards.index');
Route::get('/boards/{board}', [BoardController::class, 'show'])->name('boards.show');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/boards/{board}/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::post('/threads/{thread}/posts', [PostController::class, 'store'])->name('posts.store');
    
    // Routes for editing and deleting posts
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Routes for deleting threads and posts
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/threads/bulk-delete', [AdminController::class, 'bulkDeleteThreads'])->name('admin.threads.bulk-delete');
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users.index');
    Route::post('/admin/users/{user}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::get('/boards/create', [BoardController::class, 'create'])->name('boards.create');
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
    Route::delete('/boards/{board}', [BoardController::class, 'destroy'])->name('boards.destroy');
});

// Authentication routes provided by Laravel UI
Auth::routes();

// Redirect /home to the boards index
Route::get('/home', function () {
    return redirect()->route('boards.index');
});
