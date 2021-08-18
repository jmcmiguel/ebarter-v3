<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfferImagesController;
use App\Http\Controllers\ConversationController;

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


// Unprotected Routes
Route::group([], function() {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    })->name('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    
    // Post Controller Routes
    Route::resource('post', PostController::class);
    Route::get('getPostAuthor/{postID}', [PostController::class, 'extractUser']);
    Route::get('postExistsInConversation/{postID}', [PostController::class, 'postExistsInConversation']);
    Route::get('postOffers/{postID}', [PostController::class, 'getPostOffers']);
    Route::get('getAuthUserPosts', [PostController::class, 'getAuthUserPosts']);
    Route::get('getUserPosts/{userID}', [PostController::class, 'getUserPosts']);

    // Post Image Controller Routes
    Route::post('postImg/process', [PostImageController::class, 'store']);
    Route::post('postImg/revert', [PostImageController::class, 'revert']);
    Route::get('postImg/{postID}', [PostImageController::class, 'getPostImage']);
    
    // Cart Controller Routes
    Route::resource('cart', CartController::class);

    // Offer Controller Routes
    Route::resource('offer', OfferController::class);
    Route::put('rejectOffer/{offerID}', [OfferController::class, 'rejectOffer'])->name('rejectOffer');
    Route::post('offerExists/post/{postID}/user/{userID}', [OfferController::class, 'offerExists']);
    Route::put('acceptOffer/{offerID}', [OfferController::class, 'acceptOffer']);

    // Message Controller Routes
    Route::resource('message', MessageController::class);
    Route::get('messages/{convoID}', [MessageController::class, 'getMessages']);
    Route::get('lastMessage/{convoID}', [MessageController::class, 'getLastMessage']);
    Route::post('msgImg/process', [MessageController::class, 'storeImage']);    
   
    // User Controller Routes 
    Route::get('user/{id}', [UserController::class, 'getUser']);
    Route::get('currentUser', [UserController::class, 'getCurrentUser']);
 
    // Offer Images Controller
    Route::get('offerImages/{offerID}', [OfferImagesController::class, 'getOfferImage']);
});

// Protected Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', [PostController::class, 'sortPosts'])->name('dashboard');
    Route::get('/profile/{id?}', [UserController::class, 'getProfile'])->name('userProfile');
    Route::get('/messages', [ConversationController::class, 'showConversations'])->name('messages');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::get('/offersMade', [OfferController::class, 'showOffers'])->name('offersMade');
});