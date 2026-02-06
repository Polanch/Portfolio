<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioStatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('main');
});

Route::get('/blogs', function () {
    return view('blogs');
});

Route::get('/projects', function () {
    return view('projects');
});

// Portfolio Stats Routes
Route::post('/api/portfolio-views/increment', [PortfolioStatController::class, 'incrementView']);
Route::get('/api/portfolio-views', [PortfolioStatController::class, 'getViews']);

// Comments Routes - Public reads, authenticated writes
Route::get('/api/comments', [CommentController::class, 'getComments']);

// Protected comment routes - require authentication
Route::middleware('auth')->group(function () {
    Route::post('/api/comments', [CommentController::class, 'store']);
    Route::post('/api/comments/{comment}/vote', [CommentController::class, 'vote']);
    Route::delete('/api/comments/{comment}', [CommentController::class, 'destroy']);
});

// Auth Routes
Route::post('/api/auth/register', [AuthController::class, 'register']);
Route::post('/api/auth/login', [AuthController::class, 'login']);
Route::post('/api/auth/logout', [AuthController::class, 'logout']);
Route::get('/api/auth/user', [AuthController::class, 'user']);

// Traditional logout route
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/privacy', function () {
    return view('privacy');
});