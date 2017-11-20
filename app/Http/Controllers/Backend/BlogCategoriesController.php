<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest;
use App\BlogCategory;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;
use Yajra\Datatables\Datatables;

/**
 * Class BlogCategoriesController.
 */
class BlogCategoriesController extends Controller
{
    /**
     * @var BlogCategoriesRepository
     */
    protected $blogcategories;

    /**
     * @param BlogCategoriesRepository $blogcategories
     */
    public function __construct(BlogCategoriesRepository $blogcategories)
    {
        $this->blogcategories = $blogcategories;
    }

    /**
     * index
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.blogcategories');
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
        return Datatables::of(BlogCategory::query())->make(true);
    }

    /**
     * create blog category
     *
     * @return view
     */
    public function create()
    {
        return view('backend.create_blog_category');
    }

    /**
     * save blog category
     *
     * @param StoreBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogCategoriesRequest $request)
    {
        $this->blogcategories->create($request->all());

        return redirect()->route('admin.blogcategories.index')->withFlashSuccess(trans('alerts.backend.blogcategories.created'));
    }
    
    /**
     * edit blog category
     *
     * @param id          $primary key
     * @param EditBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function edit($id)
    {
        $blogcategory = $this->blogcategories->getRecord($id);

        return view('backend.edit_blog_category')
            ->withBlogcategory($blogcategory);
    }

    /**
     * Update blog category
     *
     * @param BlogCategory                $blogcategory
     * @param UpdateBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function update(BlogCategory $blogcategory, UpdateBlogCategoriesRequest $request)
    {
        $this->blogcategories->update($blogcategory, $request->all());

        return redirect()->route('admin.blogcategories.index')->withFlashSuccess(trans('alerts.backend.blogcategories.updated'));
    }

    /**
     * delete blog category
     *
     * @param primary key  $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->blogcategories->delete($id);

        return redirect()->route('admin.blogcategories.index')->withFlashSuccess(trans('alerts.backend.blogcategories.deleted'));
    }

}
