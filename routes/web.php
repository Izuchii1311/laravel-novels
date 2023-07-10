<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

# Home
Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

# Downloads
Route::get('/downloads', function () {
    return view('downloads', [
        "title" => "Downloads"
    ]);
});

# Category
Route::get('/categories', [CategoryController::class, 'index']);

# News
Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);

# About
Route::get('/about', function () {
    return view('about', [
        "title" => "About"
    ]);
});

# Login
Route::get('/login', [LoginController::class, "index"]);

# Register
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

# Admin/Index
Route::get('/dashboard/index', function () {
    return view('dashboard.index', [
        "title" => "Dashboard Admin"
    ]);
});
