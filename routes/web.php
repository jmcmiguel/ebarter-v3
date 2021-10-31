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
use App\Http\Controllers\BarterController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportImageController;
use App\Http\Controllers\ReportController;

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
    Route::get('getPost/{postID}', [PostController::class, 'get']);
    Route::get('postExists/{postID}', [PostController::class, 'exists']);

    //Report Image Controller Routes
    Route::post('reportImg/process', [ReportImageController::class, 'store']);
    Route::post('reportImg/revert', [ReportImageController::class, 'revert']);

    // Post Image Controller Routes
    Route::post('postImg/process', [PostImageController::class, 'store']);
    Route::post('postImg/revert', [PostImageController::class, 'revert']);
    Route::get('postImg/{postID}', [PostImageController::class, 'getPostImage']);

    // Report Controller Routes
    Route::post('report/store', [ReportController::class, 'store']);
    
    // Cart Controller Routes
    Route::resource('cart', CartController::class);

    // Offer Controller Routes
    Route::resource('offer', OfferController::class);
    Route::put('rejectOffer/{offerID}', [OfferController::class, 'rejectOffer'])->name('rejectOffer');
    Route::post('offerExists/post/{postID}/user/{userID}', [OfferController::class, 'offerExists']);
    Route::put('acceptOffer/{offerID}', [OfferController::class, 'acceptOffer']);
    Route::get('getOffer/{offerID}', [OfferController::class, 'get']);
    Route::get('getOfferOfAuthUser/{postID}/{otherUserID}', [OfferController::class, 'getOfferOfAuthUser']);

    // Message Controller Routes
    Route::resource('message', MessageController::class);
    Route::get('messages/{convoID}', [MessageController::class, 'getMessages']);
    Route::get('lastMessage/{convoID}', [MessageController::class, 'getLastMessage']);
    Route::post('msgImg/process', [MessageController::class, 'storeImage']);   
    
    // Conversation Controller Routes
    Route::get('conversation/{convoID}', [ConversationController::class, 'getConversation']);
    Route::get('conversations', [ConversationController::class, 'getConversations']);
    Route::get('getConvoFromPost/{postID}', [ConversationController::class, 'getConvoFromPost']);
   
    // User Controller Routes 
    Route::get('user/{id}', [UserController::class, 'getUser']);
    Route::get('currentUser', [UserController::class, 'getCurrentUser']);
    Route::get('name/{id}', [UserController::class, 'getName']);
 
    // Offer Images Controller
    Route::get('offerImages/{offerID}', [OfferImagesController::class, 'getOfferImage']);

    // Barter Controller
    Route::post('startBarter', [BarterController::class, 'startBarter']);
    Route::get('barterExists/{convoID}', [BarterController::class, 'barterExists']);
    Route::get('barterDone/{postID}', [BarterController::class, 'isDone']);

    // Feedback Controller
    Route::resource('feedback', FeedbackController::class);
    Route::get('getFeedback/{postID}', [FeedbackController::class, 'getFeedback']);
    Route::get('getUserFeedbacks/{userID}', [FeedbackController::class, 'getUserFeedbacks']);
    Route::get('getAllFeedback/{userID}', [FeedbackController::class, 'getAllFeedback']);
});

// Protected Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', [PostController::class, 'sortPosts'])->name('dashboard');
    Route::get('/profile/{id?}', [UserController::class, 'getProfile'])->name('userProfile');
    Route::get('/messages', [ConversationController::class, 'showConversations'])->name('messages');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::get('/offersMade', [OfferController::class, 'showOffers'])->name('offersMade');
    Route::get('/getTransactionHistory', [UserController::class, 'getTransactionHistory'])->name('transactionHistory');
});