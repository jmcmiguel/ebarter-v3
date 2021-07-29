<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Models\User;
use App\Models\PostImage;
use App\Models\Post;
use App\Models\Cart;
use Illuminate\Support\Facades\Crypt;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{category?}', function ($category = 'all') {
    if($category == 'all'){
        $posts = Post::orderBy('updated_at', 'desc')->paginate(12);
        return Inertia::render('Dashboard', ['posts' => $posts]);
    }else{
        $posts = Post::where('category', $category)->orderBy('updated_at', 'desc')->paginate(12);
        return Inertia::render('Dashboard', ['posts' => $posts]);
    }
    
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{id?}', function ($id) {

    $posts = Post::where('user_id', $id)->paginate(12);
    
    return Inertia::render('Profile', [
        'posts' => $posts,
        'id' => $id,
    ]);
    
})->name('userProfile');


Route::group(['middleware' => 'auth'], function() {
    Route::resource('post', PostController::class);
    Route::resource('cart', CartController::class);
    Route::post('postImg/process', [PostImageController::class, 'store']);
    Route::post('postImg/revert', [PostImageController::class, 'revert']);

    Route::get('user/{id}', function($id) {
        $user = User::find($id);
        $filtered =$user->only(['name','city', 'profile_photo_path', 'id', 'contact_number', 'email','bio']);
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

    Route::get('getUserPosts/{userID}', [PostController::class, 'getUserPosts']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/messages', function () {
    return Inertia::render('Messages');
})->name('messages');

Route::middleware(['auth:sanctum', 'verified'])->get('/cart', function () {

    // Get the content of the user's cart
    $cart = Cart::where('user_id', Auth::user()->id)->get();

    $postIds = [];
    
    // Store all the post id's in postIds Array
    foreach($cart as $cartItem) {
        array_push($postIds, $cartItem->post_id);
    }

    // Get all posts containg the gathered postIds
    $posts = Post::whereIn('id', $postIds)->paginate(12);

    return Inertia::render('Cart', [
        'posts' => $posts
    ]);
})->name('cart');