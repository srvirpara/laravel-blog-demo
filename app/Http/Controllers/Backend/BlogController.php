<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Post;
use App\BlogCategory;
use App\BlogTag;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;
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
     * getIndex
     *
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('backend.blog');
    }

    /**
     * getData
     *
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of(Post::query())->make(true);
    }

    /**
     * create
     *
     * @return view
     */
    public function create()
    {
        $blogCategories = BlogCategory::where('status', 1)->pluck('name', 'id');
        $blogTags       = BlogTag::where('status', 1)->pluck('name', 'id');

        return view('backend.create_blog',compact('blogCategories', 'blogTags'));
    }

     /**
     * store
     *
     * @param StoreBlogsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogsRequest $request)
    {
        $input      = $request->all();
        $tagsArray  = $this->createTagsArray($input['tags']);
        $this->blogs->create($input, $tagsArray);

        return redirect()->route('admin.blog.index')->withFlashSuccess(trans('alerts.backend.blogs.created'));
    }

    /**
     * createTagsArray : Creating Tags Array.
     *
     * @param Array($tags)
     *
     * @return array
     */
    public function createTagsArray($tags)
    {
        //Creating a new array for tags (newly created)
        $tags_array = [];

        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                $tags_array[] = $tag;
            } else {
                $newTag       = BlogTag::create(['name' => $tag, 'status' => 1, 'created_by' => 1]);
                $tags_array[] = $newTag->id;
            }
        }

        return $tags_array;
    }


     /**
     * edit : edit blog 
     *
     * @param Blog $blog
     * @param id $id
     *
     * @return mixed
     */
    public function edit($id,Post $blog)
    {
        $blogCategories = BlogCategory::where('status', 1)->pluck('name', 'id');
        $blogTags       = BlogTag::where('status', 1)->pluck('name', 'id');
        $selectedtags   =  $this->blogs->getSelectedTags($id);
        $blog           = $this->blogs->getRecord($id);

        return view('backend.edit_blog', 
            compact(
                'blogCategories',
                'blogTags',
                'selectedtags')
            )
            ->withBlog($blog);
    }


     /**
     * update : update blog request
     *
     * @param Blog               $blog
     * @param UpdateBlogsRequest $request
     *
     * @return mixed
     */
    public function update(Post $blog, UpdateBlogsRequest $request)
    {
        $input     = $request->all();
        $tagsArray = $this->createTagsArray($input['tags']);
        
        $this->blogs->update($blog, $input, $tagsArray);

        return redirect()->route('admin.blog.index')->withFlashSuccess(trans('alerts.backend.blogs.updated'));
    }

    /**
     * destroy : delete blog
     *
     * @param Primary key $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->blogs->delete($id);

        return redirect()->route('admin.blog.index')->withFlashSuccess(trans('alerts.backend.blogs.deleted'));
    }
}
