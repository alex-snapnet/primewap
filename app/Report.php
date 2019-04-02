<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $dates=['day_week'];
    protected $fillable=['report' ,'user_id','day_week','agro_id','status','prog_status','lmodified_id'];

    public function user(){
    	return $this->belongsTo('App\User','user_id')->withDefault();
    }

    public function agrolytic(){
    	return $this->belongsTo('App\Agrolytic','agro_id')->withDefault();
    }

    public function lmodified(){
    	return $this->belongsTo('App\User','lmodified_id')->withDefault();
    }
}
