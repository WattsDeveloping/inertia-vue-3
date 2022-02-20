<?php

use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Inertia renders the routes we need
 */
Route::get('/', function () {
    return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
    ]);
});

/**
 * /dashboard
 * Can't get passed this with out using the middleware auth
 */
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * /posts
 * Handles the view for the posts
 */
Route::resource('posts', PostController::class);

require __DIR__ . '/auth.php';