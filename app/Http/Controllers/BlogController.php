<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\BlogMapTag;
use App\BlogTag;
use Carbon\Carbon;

class BlogController extends Controller
{

    /**
     * index
     *
     * to display blog page
     *
     * @return view
     */
    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())
                ->orderBy('published_at', 'desc')
                ->paginate(config('blog.posts_per_page'));

        return view('blog.index', compact('posts'));
    }


    /**
     * showPost
     *
     * @param Blog slug $slug
     *
     * @return view
     */
    public function showPost($slug)
    {
       
        $post = Post::with('tags')->select('posts.*','blog_category.name as category')
                ->leftJoin('blog_category', 'blog_category.id', '=', 'posts.blog_category_id')
                ->where('posts.slug', $slug)
                ->first();

        return view('blog.post', compact('post'));
    }
}
