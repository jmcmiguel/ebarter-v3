<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Offer;
use App\Models\Conversation;
use App\Models\Barter;
use App\Models\Category;
use App\Models\QuantityType;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show all User
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Get a single user
     *
     * @return Response
     */
    public function get($userID)
    {
        $user = User::find($userID);
        $filtered =$user->only(['name','city']);
        return response()->json($filtered);
    }

    /**
     * Get data of a user
     * 
     * @param UserID
     * @return JSON
     */
    public function getUser($id){
        $user = User::find($id);
        $filtered = $user->only(['name','city', 'profile_photo_path', 'id', 'contact_number', 'email','bio']);
        return response()->json($filtered);
    }

    /**
     * Display user profile
     * 
     * @param UserID
     * @return Inertia
     */
    public function getProfile($id){
        $user = User::findOrFail($id);

        $posts = Post::where('user_id', $id)->orderBy('updated_at','desc')->paginate(12);

        $categories = Category::orderBy('id', 'asc')->get();
        $qtyType = QuantityType::orderBy('id', 'asc')->get();

        return Inertia::render('Profile', [
            'posts' => $posts,
            'id' => $id,
            'categories' => $categories,
            'qtyTypes' => $qtyType
        ]);
    }

    /**
     * Get Current Authenticated User
     * 
     * @return JSON
     */
    public function getCurrentUser(){
        return response()->json(Auth::user());
    }

    /**
     * Get name of a user
     * 
     * @return String
     */
    public function getName($id){

        $user = User::findOrFail($id);

        return $user->name;
    }

     /**
     * Displays the transaction history
     *
     * @return Inertia
     */
    public function getTransactionHistory (Request $request){

        $posts = Post::where('user_id', Auth::user()->id)
                ->orderBy('updated_at', 'desc')
                ->get();
        
        $off = Offer::orderBy('updated_at', 'desc')
                ->get();
        
        $offerss = $off->filter(function ($offer, $key) use($posts) {
            return $offer->user_id == Auth::user()->id || $posts->contains('id', $offer->post_id);
        });
        
        $offers = $offerss->isEmpty() 
                ? Offer::where('id', '<', 0)->paginate(12)
                : $offerss->customPaginate(12)->withQueryString();

        return Inertia::render('TransactionHistory', ['offers' => $offers]);
    }

    /**
     * Displays The types 
     * 
     * @return Inertia
     */
    public function modifyTypes(){
        if(Auth::user()->access_level && Auth::user()->access_level === 1){

            $categories = Category::orderBy('id', 'asc')->get();
            $qtyType = QuantityType::orderBy('id', 'asc')->get();

            return Inertia::render('ModifyTypes',  ['categories' => $categories, 'qtyTypes' => $qtyType] );
            
        }else{
            return abort(403);
        }
    }
}
