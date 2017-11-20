<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\BlogTag;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;
use Yajra\Datatables\Datatables;

/**
 * Class BlogTagsController.
 */
class BlogTagsController extends Controller
{
    /**
     * @var BlogTagsRepository
     */
    protected $blogtags;

    /**
     * @param blogtagsRepository $blogtags
     */
    public function __construct(BlogTagsRepository $blogtags)
    {
        $this->blogtags = $blogtags;
    }

     /**
     * index
     *
     * @param ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.blogtag');
    }

    /**
     * get blog tags data
     *
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of(BlogTag::query())->make(true);
    }

    /**
     * Create blog tags
     *
     * @param CreateBlogTagsRequest $request
     *
     * @return mixed
     */
    public function create()
    {
         return view('backend.create_blog_tag');
    }

    /**
     * save blog tags
     *
     * @param StoreblogtagsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogTagsRequest $request)
    {
        $this->blogtags->create($request->all());

        return redirect()->route('admin.blogtag.index')->withFlashSuccess(trans('alerts.backend.blogtags.created'));
    }

    /**
     * Edit blog tags
     *
     * @param primary key        $key
     *
     * @return mixed
     */
    public function edit($id)
    {
        $blogtag = $this->blogtags->getRecord($id);
        return view('backend.edit_blog_tag')
            ->withBlogtag($blogtag);
    }

    /**
     * update blog tags data
     *
     * @param BlogTag               $blogtag
     * @param UpdateblogtagsRequest $request
     *
     * @return mixed
     */
    public function update(BlogTag $blogtag, UpdateBlogTagsRequest $request)
    {
        $this->blogtags->update($blogtag, $request->all());

        return redirect()->route('admin.blogtag.index')->withFlashSuccess(trans('alerts.backend.blogtags.updated'));
    }

    /**
     * delete blog tags
     *
     * @param primary key     $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->blogtags->delete($id);

        return redirect()->route('admin.blogtag.index')->withFlashSuccess(trans('alerts.backend.blogtags.deleted'));
    }
}
