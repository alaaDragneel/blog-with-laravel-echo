<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscribedTags extends Model { 

 	public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function tag ()
    {
        return $this->belongsTo(Tag::class);
    }
}
