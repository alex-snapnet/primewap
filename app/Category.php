<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];

    public function user(){
    	return $this->belongsTo('App\User','name');
    }

    public function agrolytic(){
    	return $this->hasMany('App\Agrolytic','cat_id');
    }
}
