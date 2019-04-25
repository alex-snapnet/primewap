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

    function comments(){
        return $this->hasMany(Comment::class,'user_id');
    }

    function altered_comments(){
        return $this->hasMany(Comment::class,'user_id')->where('');
    }

    function replies(){
        return $this->hasMany(Reply::class,'user_id');
    }




    function canAlterComment($comment){
      $ref = $this;  
      $query = $this->withCount(
          ['comments'=>function(\Illuminate\Database\Eloquent\Builder $builder) use ($comment,$ref){
                    $builder->where('comments.id',$comment->id)->where('user_id',$ref->id);
      }]);
      
      $query = $query->where('id',$this->id);
      
    //   echo $query->toSql();
    //   $sql = str_replace_array('?', $query->getBindings(), $query->toSql());
    //   echo $sql;

      $count = $query->first()->comments_count;

    //   echo $count;
      
      return ($count > 0);
    
    }

    
    // function canAlterComment($comment){
    //    return $count = $user->withCount('comments')->wh();

    //    $count->
    //     echo $count;
    //     return ($count > 0);
    //   }

      function canAlterReplies($reply_id){
       
      }




  
}
