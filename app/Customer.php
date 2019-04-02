<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable=['name','contact_email','address','phone_num','added_by'];

    public function user(){

    	return $this->belongsTo('App\User','added_by')->withDefault();
    }

    public function agrolytic(){
    	return $this->hasMany('App\Agrolytic','prospect','name');
    }
}
