<?php

namespace App\Repositories\Backend\BlogCategories;

use App\Exceptions\GeneralException;
use App\BlogCategory;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategoriesRepository.
 */
class BlogCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogCategory::class;

   
    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException('Blog category already exists.');
        }
        
        $blogcategories             = self::MODEL;
        $blogcategories             = new $blogcategories();
        $blogcategories->name       = $input['name'];
        $blogcategories->status     = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $blogcategories->created_by = \Auth::id();

        if ($blogcategories->save()) 
        {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.blogcategories.create_error'));
        
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
    public function update(Model $blogcategories, array $input)
    {

        if ($this->query()->where('name', $input['name'])->where('id', '!=', $input['id'])->first()) 
        {
            throw new GeneralException(trans('exceptions.backend.blogcategories.already_exists'));
        }

        $blogcategories               = BlogCategory::find($input['id']);
        $blogcategories->name         = $input['name'];
        $blogcategories->status       = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $blogcategories->updated_by   = \Auth::id();

        if ($blogcategories->save()) 
        {
                return true;
        }

        throw new GeneralException(
            trans('exceptions.backend.blogcategories.update_error')
        );
    }

    /**
     * @param primary key $id
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($id)
    {
            
        $blogcategory = BlogCategory::find($id);
        if ($blogcategory->delete()) 
        {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.blogcategories.delete_error'));
       
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
        return BlogCategory::find($id);
    }
}
