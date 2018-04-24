<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{


    /**
    * [$this->belongsToMany description]
    * @param First @param The Main Model Table Relation
    * @param Second @param The Storing NOTE Table NOT Model table  Relation
    * @param Thired @param The Column Relation This Model
    * @param Second @param The Column Relation Other Model
    */
    
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_tags', 'tag_id', 'post_id');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(User::class, 'user_subscribed_tags', 'tag_id', 'user_id');
    }
}
