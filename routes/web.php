<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

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
Route::get('/login', [LoginController::class, "index"])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, "authenticate"]);
# Logout
Route::post('/logout', [LoginController::class, 'logout']);

# Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

# Admin/Index
Route::get('/dashboard', function() {
    $posts = Post::where('user_id', auth()->user()->id)
        ->latest()
        ->paginate(5)
        ->withQueryString();                 # mengembalikkan data dari user yang sudah melakukan login

    $totalPosts = $posts->total();
    $pageNumber = ($posts->currentPage() -1 ) * $posts->perPage();

    return view('dashboard.index', [
        "title" => "Dashboard Admin",
        "totalPost" => $totalPosts,
        "totalCategory" => Category::count(),
        "posts" => $posts,
        "pageNumber" => $pageNumber
    ]);
})->middleware('auth');

# Admin/Posts
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');