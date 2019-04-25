<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $table = 'replies';

    function comment(){
        return $this->belongsTo(Comment::class,'comment_id');
    }

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
