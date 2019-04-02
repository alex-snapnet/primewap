<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Repositories\traits\Micellenous;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable , Micellenous;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customer(){
        return $this->hasMany('App\Customer','added_by');
    }

    public function customers(){
        return \App\Customer::get();
    }

    public function oprep($id){
        return $this->where('id',$id)->value('name');
    }
  
}
