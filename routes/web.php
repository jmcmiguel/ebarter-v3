<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\PostImage;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    $posts = Post::orderBy('id', 'desc')->paginate(12);

    return Inertia::render('Dashboard', [
        'posts' => $posts
    ]);
    
    return Inertia::render('Dashboard', ['posts', $posts]);
    
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {

    $posts = Post::where('user_id', Auth::user()->id)->paginate(12);
    
    return Inertia::render('Profile', [
        'posts' => $posts
    ]);
    
})->name('userProfile');


Route::group(['middleware' => 'auth'], function() {
    Route::resource('post', PostController::class);
    Route::post('postImg/process', [PostImageController::class, 'store']);
    Route::post('postImg/revert', [PostImageController::class, 'revert']);

    Route::get('user/{id}', function($id) {
        $user = User::find($id);
        $filtered =$user->only(['name','city', 'profile_photo_path', 'id']);
        return response()->json($filtered);
    });

    Route::get('currentUser', function(){
        return response()->json(Auth::user());
    });

    Route::get('postImg/{postID}', function($postID) {
        $postImages = PostImage::where('post_id', $postID)->get();
        return response()->json($postImages);
    });

    Route::get('getAuthUserPosts', [PostController::class, 'getAuthUserPosts']);

});

Route::middleware(['auth:sanctum', 'verified'])->get('/messages', function () {
    return Inertia::render('Messages');
})->name('messages');

Route::middleware(['auth:sanctum', 'verified'])->get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart');