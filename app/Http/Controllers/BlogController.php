<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

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

    public function category(Category $category) 
    { 
    	$categoryName = $category->title;

    	// \DB::enableQueryLog();
    	 $posts = $category->posts()
    	 			->with('author')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
         // dd(\DB::getQueryLog());
        return view("blog.index", compact('posts', 'categoryName'));
    } 

    public function author(User $author)
    {
        $authorName = $author->name;

        // \DB::enableQueryLog();
         $posts = $author->posts()
                    ->with('category')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
         // dd(\DB::getQueryLog());
        return view("blog.index", compact('posts', 'authorName'));
    }

    public function show(Post $post)
    {
       	return view("blog.show", compact('post'));
    }
}
