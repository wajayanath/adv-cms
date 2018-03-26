<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    protected $limit = 3;

    public function index()
    { 
    	// \DB::enableQueryLog();
    	 $posts = Post::with('author')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
        
        // view("blog.index", compact('posts'))->render();
        // dd(\DB::getQueryLog());
        return view("blog.index", compact('posts'));
    } 

    public function show(Post $post)
    {
    	return view("blog.show", compact('post'));
    }
}
