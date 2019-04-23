<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=['user_id','agro_id','comment','type'];

    public function user(){
    	return $this->belongsTo('App\User','user_id')->withDefault();
    }

    public function agrolytic(){
    	return $this->belongsTo('App\Agrolytic','agro_id')->withDefault();
    }

    function replies(){
        return $this->hasMany(Reply::class,'comment_id');
    }
}
