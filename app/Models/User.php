<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\UserNotification', 'id', 'user_id');
    }

    public function subscribed_tags_table()
    {
        return $this->hasMany('App\Models\UserSubscribedTags', 'user_id');
    }

    public function saved_posts_table()
    {
        return $this->hasMany('App\Models\SavedPosts', 'id', 'user_id');
    }

    /**
     * [$this->belongsToMany description]
     * @param First @param The Main Model Table Relation
     * @param Second @param The Storing NOTE Table NOT Model table  Relation
     * @param Thired @param The Column Relation This Model
     * @param Second @param The Column Relation Other Model
     */

    public function subscribed_tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'user_subscribed_tags', 'user_id', 'tag_id');
    }

    public function saved_posts()
    {
        return $this->belongsToMany('App\Models\Post', 'saved_posts', 'user_id', 'post_id');
    }

}
