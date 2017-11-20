<?php

namespace App;

use App\BlogTag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['published_at'];

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;

        if (!$this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    /**
     * Blogs has many relationship with tags.
     */
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_map_tags', 'blog_id', 'tag_id');
    }
}
