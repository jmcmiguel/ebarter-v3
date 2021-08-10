<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
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
}
