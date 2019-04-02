<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    function agrolytics(){
        return $this->hasMany(Agrolytic::class,'sec_id');
    }
    
}
