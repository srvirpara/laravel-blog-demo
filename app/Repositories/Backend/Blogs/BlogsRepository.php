<?php

namespace App\Repositories\Backend\Blogs;

use App\Exceptions\GeneralException;
use App\BlogMapTag;
use App\BlogTag;
use App\Post as Blog;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogsRepository.
 */
class BlogsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Blog::class;

   
    /**
     * @param array $input
     * @param array $tagsArray
     * @param array $categoriesArray
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input, array $tagsArray)
    {
            $blogs                    = self::MODEL;
            $blogs                    = new $blogs();
            $blogs->title             = $input['name'];
            $blogs->slug              = str_slug($input['name']);
            $blogs->content           = $input['content'];
            $blogs->blog_category_id  = $input['categories'];
            $blogs->published_at      = Carbon::parse($input['publish_datetime']);
            $blogs->meta_title        = $input['meta_title'];
            $blogs->meta_keywords     = $input['meta_keywords'];
            $blogs->meta_description  = $input['meta_description'];
            
            if ($blogs->save()) 
            {
                
                // Inserting associated tag's id in mapper table
                for ($i = 0; $i < count($tagsArray); $i++) 
                {
                    $blogMapTags[] = [
                        'blog_id' => $blogs->id,
                        'tag_id'  => $tagsArray[$i],
                    ];
                }

                BlogMapTag::insert($blogMapTags);

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.blogs.create_error'));
       
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
    public function update(Model $blogs, array $input, array $tagsArray)
    {
        $blogs                   = Blog::find($input['id']);
        $blogs->title            = $input['name'];
        $blogs->slug             = str_slug($input['name']);
        $blogs->content          = $input['content'];
        $blogs->blog_category_id = $input['categories'];
        $blogs->published_at     = Carbon::parse($input['publish_datetime']);
        $blogs->meta_title       = $input['meta_title'];
        $blogs->meta_keywords    = $input['meta_keywords'];
        $blogs->meta_description = $input['meta_description'];
       
        if ($blogs->save()) 
        {

            // Updating associated tag's id in mapper table
            BlogMapTag::where('blog_id', $blogs->id)->delete();
            for ($i = 0; $i < count($tagsArray); $i++) 
            {
                $blogMapTags[] = [
                    'blog_id' => $blogs->id,
                    'tag_id'  => $tagsArray[$i],
                ];
            }

            BlogMapTag::insert($blogMapTags);

            return true;
        }

        throw new GeneralException(
            trans('exceptions.backend.blogs.update_error')
        );
       
    }

    /**
     * @param id $id
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($id)
    {
        $blog = Blog::find($id);
        
        if ($blog->delete()) 
        {
            BlogMapTag::where('blog_id', $blog->id)->delete();

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.blogs.delete_error'));
        
    }

    /**
     * @param id $id
     *
     * @throws GeneralException
     *
     * @return object
     */
    public function getRecord($id)
    {
        return Blog::find($id);
    }

    /**
     * @param id $id
     *
     * @throws GeneralException
     *
     * @return Array
     */
    public function getSelectedTags($id)
    {

        $tags_array = BlogMapTag::where('blog_id', $id)->pluck('tag_id')->toArray();
        return $tags_array;
        
    }

    /**
     * get All Published Blogs
     *
     * @throws GeneralException
     *
     * @return Array
     */
    public function getAllBlogs()
    {

        $posts = Blog::where('published_at', '<=', Carbon::now())
                ->orderBy('published_at', 'desc')
                ->paginate(config('blog.posts_per_page'));

        return $posts;
        
    }

    /**
     * get Blog details
     *
     * @throws GeneralException
     *
     * @return Array
     */
    public function getBlogDetails($slug)
    {

        $post = Blog::with('tags')->select('posts.*','blog_category.name as category')
                ->leftJoin('blog_category', 'blog_category.id', '=', 'posts.blog_category_id')
                ->where('posts.slug', $slug)
                ->first();

        return $post;
        
    }
}
