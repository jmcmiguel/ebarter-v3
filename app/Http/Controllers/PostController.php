<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Show all Post
     *
     * @return Response
     */
    public function index()
    {
        $data = Post::all();
        return Inertia::render('posts', ['data' => $data]);
    }
  
    /**
     * Creates a new Post
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'post_title' => ['required'],
            'post_desc' => ['required'],
            'prod_name' => ['required'],
            'prod_qty' => ['required','numeric','gt:0'],
            'category' => ['required'],
            'qty_type' => ['required'],
            'date_produced' => ['required','date','after_or_equal:yesterday'], // only accept dates after today
            'date_expired' => ['required','date','after_or_equal:date_produced'],
            'pref_prod' => ['required'],
        ])->validate();

        Post::create([
            'user_id' => 01,
            'title' => $request->post_title,
            'description' => $request->post_desc,
            'prod_name' => $request->post_desc,
            'prod_qty' => $request->prod_qty,
            'qty_type' => $request->qty_type,
            'date_produced' => $request->date_produced,
            'date_expiree' => $request->date_expired,
            'status' => 'available',
            'category' => $request->category,
            'views' => 0,
            'preferred_prod' => $request->pref_prod,
        ]);

        $request->session()->flash('flash.banner', 'New Post Created!');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back()
                    ->with('message', 'Post Created Successfully.');
    }
  
    /**
     * Update a Post
     *
     * @return Response
     */
    public function update(Request $request)
    {
    }
  
    /**
     * Destroy a Post
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
    }
}
