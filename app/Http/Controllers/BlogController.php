<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\BlogMapTag;
use App\BlogTag;
use Carbon\Carbon;
use App\Repositories\Backend\Blogs\BlogsRepository;

class BlogController extends Controller
{

    /**
     * @var BlogsRepository
     */
    protected $blogs;

    /**
     * @param BlogsRepository $blogs
     */
    public function __construct(BlogsRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * index
     *
     * to display blog page
     *
     * @return view
     */
    public function index()
    {
        $posts = $this->blogs->getAllBlogs();
       
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

        $post = $this->blogs->getBlogDetails($slug);
       
        return view('blog.post', compact('post'));
    }
}
