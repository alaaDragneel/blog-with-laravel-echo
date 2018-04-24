<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $with = ['user', 'tags', 'comments'];

    public function tags()
    {
        /**
         * [$this->belongsToMany description]
         * @param First @param The Main Model Table Relation
         * @param Second @param The Storing NOTE Table NOT Model table  Relation
         * @param Thired @param The Column Relation
         * @param Second @param The Column Relation
         */
        return $this->belongsToMany('App\Models\Tag', 'post_tags', 'post_id', 'tag_id');
    }
    public function tags_table()
    {
        return $this->hasMany('App\Models\PostTags', 'post_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }
}
