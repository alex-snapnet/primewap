<?php

namespace App;

use App\Sector;
use App\Customer;
use App\Repositories\traits\Micellenous;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder; //import this for the query-builder.

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

    function tasks(){
        return $this->hasMany(Agrolytic::class,'user_id');
    }

    function reports(){ //milestones
       return $this->hasMany(Report::class,'user_id');
    }

    function categories(){
        return $this->hasMany(Category::class,'user_id');
    }

    function sectors(){
        return $this->hasMany(Sector::class,'user_id');
    }

    public function oprep($id){
        return $this->where('id',$id)->value('name');
    }

    function comments(){
        return $this->hasMany(Comment::class,'user_id');
    }

    function altered_comments(){
        return $this->hasMany(Comment::class,'user_id')->where('');
    }

    function replies(){
        return $this->hasMany(Reply::class,'user_id');
    }

    function groups(){
        return $this->hasMany(GroupName::class,'user_id');
    }




    function canAlterComment($comment){
      return $this->checkAlterCapability($comment,'comments','comments');
    }

      function canAlterReplies($reply){
        return $this->checkAlterCapability($reply,'replies','replies');      
      }

      function canAlterGroup($group){
        return $this->checkAlterCapability($group,'groups','group_names');      
      }


      function canAlterTasks($task){
        return $this->checkAlterCapability($task,'tasks','agrolytics');      
      }

      function canAlterCategories($category){
        return $this->checkAlterCapability($category,'categories','categories');      
      }

      function canAlterCustomers($customer){
        return $this->checkAlterCapability($customer,'customers','customers');      
      }

      function canAlterReports($report){
        return $this->checkAlterCapability($report,'reports','reports');
      }

      private function checkAlterCapability($obj,$relation,$table){
        $ref = $this;  
        $query = $this->withCount(
            [$relation=>function(Builder $builder) use ($obj,$ref,$table){
                      $builder->where($table . '.id',$obj->id)->where('user_id',$ref->id);
        }]);
        $query = $query->where('id',$this->id);
        $count_field = $relation . '_count';
        $count = $query->first()->$count_field;
        return ($count > 0);         
      }


      function canAlterSectors($sector){
        return $this->checkAlterCapability($sector,'sectors','sectors');
      }

      function canAlterGroups($group){

      }

    //   function canAlterCustomers($customer){

    //   }


      function getAccessDeniedError(){
          return [
               'message'=>'You do not have the permission to perform this action!',
               'error'=>true
          ];
      }




  
}
