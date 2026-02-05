<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioStatController;

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
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/privacy', function () {
    return view('privacy');
});