<?php

namespace App\Repositories\Backend\BlogTags;

use App\Exceptions\GeneralException;
use App\BlogTag;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogTagsRepository.
 */
class BlogTagsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BlogTag::class;

    

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
            throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
        }
       
        $blogtags             = self::MODEL;
        $blogtags             = new $blogtags();
        $blogtags->name       = $input['name'];
        $blogtags->status     = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $blogtags->created_by = \Auth::id();

        if ($blogtags->save()) 
        {
            
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.blogtags.create_error'));
        
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
    public function update(Model $blogtags, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $input['id'])->first()) {
            throw new GeneralException(trans('exceptions.backend.blogtags.already_exists'));
        }

        $blogtags             = BlogTag::find($input['id']);
        $blogtags->name       = $input['name'];
        $blogtags->status     = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $blogtags->updated_by = \Auth::id();
       
        if ($blogtags->save()) 
        {
            
            return true;
        }

        throw new GeneralException(
            trans('exceptions.backend.blogtags.update_error')
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
            
        $blogcategory = BlogTag::find($id);

        if ($blogcategory->delete()) 
        {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.blogtags.delete_error'));
       
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
        return BlogTag::find($id);
    }
}
