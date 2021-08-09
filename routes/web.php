<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\MessageController;
use App\Models\User;
use App\Models\PostImage;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Offer;
use App\Models\OfferImage;
use App\Models\Conversation;
use App\Models\Message;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{category?}', function ($category = 'all', Request $request) {
    
    // Get Category params
    $hasCategory = $category == 'all' ? null : $category;
    
    // Get location params
    $location = isset($request->query()['location']) ? $request->query()['location'] : null;

    // Get price params
    $price = isset($request->query()['price']) ? $request->query()['price'] : null; 
    $price2 = isset($request->query()['price2']) ? $request->query()['price2'] : null; 

    // Check if filter query params exists
    $hasFilter = $price || $price2 || $location; 

    // Check existence of query params
    if($location && $price){
        if($price > 5000){
            $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($location, $price){
                return strtolower($post->user->city) === strtolower($location) &&
                        $post->est_price > 5000;
            });
        }else if($price > 100){
            $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($location, $price, $price2){
                return strtolower($post->user->city) === strtolower($location) &&
                        $post->est_price >= $price2 && $post->est_price <= $price;
            });
        }else{
            $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($location, $price){
                return strtolower($post->user->city) === strtolower($location) &&
                        $post->est_price < 100;
            });
        }
    }else if($location && $price == null){
        $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($location, $price){
            return strtolower($post->user->city) === strtolower($location);
        });
    }else if($location == null && $price){

        if($price > 5000){
            $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($price){
                return $post->est_price > 5000;
            });
        }else if($price > 100){
            $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($price, $price2){
                return $post->est_price >= $price2 && $post->est_price <= $price;
            });
        }else{
            $filterQuery = Post::with(['user'])->get()->filter(function ($post) use($price){
                return $post->est_price < 100;
            });
        }

    }else{
        $filterQuery = Post::with(['user'])->get();
    }

    // Check existence of category and filter queries
    if($hasCategory && $filterQuery->isNotEmpty()){
        $posts = $filterQuery->toQuery()->where('category', $category)->orderBy('updated_at', 'desc')->paginate(12)->withQueryString();
    }
    else if($hasCategory == null && $filterQuery->isEmpty()) {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(12);
    }
    else if($hasCategory == null && $filterQuery->isNotEmpty()){
        $posts = $filterQuery->toQuery()->whereRaw('category IS NOT NULL')->orderBy('updated_at', 'desc')->paginate(12)->withQueryString();
    }
    else if($hasCategory && $filterQuery->isEmpty()){
        $posts = Post::where('category', $category)->orderBy('updated_at','desc')->paginate(12);
    }

    // If filter exists but filterQuery is empty, return empty posts
    if($hasFilter && $filterQuery->isEmpty()){
        $posts = Post::where('id', '<', 0)->paginate(12);
    }

    return Inertia::render('Dashboard', ['posts' => $posts]);

})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{id?}', function ($id) {

    // If user does not exists, return error
    $user = User::findOrFail($id);

    $posts = Post::where('user_id', $id)->orderBy('updated_at','desc')->paginate(12);
    
    return Inertia::render('Profile', [
        'posts' => $posts,
        'id' => $id,
    ]);
    
})->name('userProfile');


Route::group(['middleware' => 'auth'], function() {
    Route::resource('post', PostController::class);
    Route::resource('cart', CartController::class);
    Route::resource('offer', OfferController::class );
    Route::resource('message', MessageController::class);
    Route::post('postImg/process', [PostImageController::class, 'store']);
    Route::post('postImg/revert', [PostImageController::class, 'revert']);
    Route::get('getPostAuthor/{postID}', [PostController::class, 'extractUser']);
    Route::get('postExistsInConversation/{postID}', function($postID){
        $existInConversation = Conversation::where('post_id', $postID)->get();
        return $existInConversation->isEmpty() ? false : true;
    });
    Route::put('rejectOffer/{offerID}', [OfferController::class, 'rejectOffer'])
        ->name('rejectOffer');

    Route::get('user/{id}', function($id) {
        $user = User::find($id);
        $filtered = $user->only(['name','city', 'profile_photo_path', 'id', 'contact_number', 'email','bio']);
        return response()->json($filtered);
    });

    Route::get('currentUser', function(){
        return response()->json(Auth::user());
    });

    Route::get('postImg/{postID}', function($postID) {
        $postImages = PostImage::where('post_id', $postID)->get();
        return response()->json($postImages);
    });

    Route::get('postOffers/{postID}', function($postID) {
        $postOffers = Offer::where('post_id', $postID)->get();
        return response()->json($postOffers);
    });

    Route::get('offerImages/{offerID}', function($offerID) {
        $offerImages = OfferImage::where('offer_id', $offerID)->get();
        return response()->json($offerImages);
    });

    Route::post('offerExists/post/{postID}/user/{userID}', function($postID,$userID, Request $request) {
        
        $alreadyExists = Offer::where([
            ['post_id', '=', $postID],
            ['user_id', '=', $userID],
        ])->first();

        if($alreadyExists){    
            return response()->json(['exists' => true]);
        }else{
            return response()->json(['exists' => false]);
        }
        
    });

    Route::get('getAuthUserPosts', [PostController::class, 'getAuthUserPosts']);

    Route::get('getUserPosts/{userID}', [PostController::class, 'getUserPosts']);

    Route::get('messages/{convoID}', function ($convoID){
        $messages = Message::where('convo_id', $convoID)->get();
        return response()->json($messages);
    });

    Route::get('lastMessage/{convoID}', function ($convoID){
        $messages = Message::where('convo_id', $convoID)->orderBy('created_at','desc')->first();
        return response()->json($messages);
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/messages', function () {


    $conversations = Conversation::with(['message'])
                ->where('sender_user_id', Auth::user()->id)
                ->orWhere('receiver_user_id', Auth::user()->id)
                ->get();

    return Inertia::render('Messages', [
        'conversations' => $conversations,
    ]);
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

Route::middleware(['auth:sanctum', 'verified'])->get('/offersMade', function () {

    $offersMade = Offer::where('user_id', Auth::user()->id)->paginate(12);

    return Inertia::render('OffersMade', ['offersMade' => $offersMade]);
})->name('offersMade');