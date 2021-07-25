<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Show all Post
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Get a single Post
     *
     * @return Response
     */
    public function get($postID)
    {
        $post = Post::find($postID);

        return response()->json($post);
    }
  
    /**
     * Creates a new Post
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'post_title' => ['required', 'string'],
            'post_desc' => ['required', 'string'],
            'prod_name' => ['required', 'string'],
            'prod_qty' => ['required','numeric','gt:0'],
            'category' => ['required', 'string'],
            'qty_type' => ['required', 'string'],
            'date_produced' => ['required','date','before_or_equal:yesterday'], // only accept dates before or today
            'date_expired' => ['required','date','after_or_equal:date_produced'],
            'pref_prod' => ['required', 'string'],
            'est_price' => ['required', 'numeric'],
        ])->validate();

        $newPost = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->post_title,
            'description' => $request->post_desc,
            'prod_name' => $request->prod_name,
            'prod_qty' => $request->prod_qty,
            'qty_type' => $request->qty_type,
            'date_produced' => $request->date_produced,
            'date_expiree' => $request->date_expired,
            'status' => 'available',
            'category' => $request->category,
            'views' => 0,
            'preferred_prod' => $request->pref_prod,
            'est_price' => $request->est_price,
        ]);

        // check if images are empty
        if($request->filled('postimg_filepath')){

            $imgPaths = $request->postimg_filepath;
            
            foreach($imgPaths as $imgPath){
                PostImage::create([
                    'post_image_path' => $imgPath,
                    'post_id' => $newPost->id,
                ]);
            }

        }

        $request->session()->flash('flash.bannerId', uniqid());
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
