<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupName extends Model
{
    //
    protected $table = 'group_names';

    function group(){
      return $this->belongsTo(GroupName::class,'group_name_id');
    }

    function groups(){
      return $this->hasMany(GroupName::class,'group_name_id');
    }



}
