<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $with = ['replies', 'user'];

    public function replies()
    {
        return $this->hasMany('App\Models\Reply', 'comment_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
