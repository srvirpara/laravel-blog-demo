<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ['name', 'status', 'created_by', 'updated_by'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'blog_category';
    }
}
