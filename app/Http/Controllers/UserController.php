<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Conversation;
use App\Models\Barter;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        
        return Inertia::render('Profile', [
            'posts' => $posts,
            'id' => $id,
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
     * Sorts the post and displays the dashboard page
     *
     * @return Inertia
     */
    public function getTransactionHistory (Request $request){

        $barters = \DB::table('barters')
        ->whereExists(function ($query) {
            $query->select(\DB::raw(1))
                    ->from('conversations')
                    ->where('conversations.sender_user_id', Auth::user()->id)
                    ->orWhere('conversations.receiver_user_id', Auth::user()->id);
        })
        ->get();
        
        return Inertia::render('TransactionHistory', ['barters' => $barters]);
    }
}
