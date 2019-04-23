<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    //
    protected $table = 'audit_trails';
    protected $fillable  = ['user_id','json_data','entity','verb'];

    private function logEntity($entity,$obj,$user_id,$verb){
       self::create([
           'user_id'=>$user_id,
           'json_data'=>$obj->toJson(),
           'entity'=>$entity,
           'verb'=>$verb
       ]);
    } 
    
    function logCategory($id,$user_id,$verb){
       $cat = Category::find($id);
       $this->logEntity('Category',$cat,$user_id,$verb);
    }

    function logSector($id,$user_id,$verb){
        $cat = Sector::find($id);
        $this->logEntity('Sector',$cat,$user_id,$verb); 
    }

    function logComment($id,$user_id,$verb){
        $cat = Comment::find($id);
        $this->logEntity('Comment',$cat,$user_id,$verb); 
    }

    function logCustomer($id,$user_id,$verb){
        $cat = Customer::find($id);
        $this->logEntity('Customer',$cat,$user_id,$verb); 
    }

    function logReport($id,$user_id,$verb){
        $cat = Report::find($id);
        $this->logEntity('Report',$cat,$user_id,$verb); 
    }

    function logUser($id,$user_id,$verb){
        $cat = User::find($id);
        $this->logEntity('User',$cat,$user_id,$verb); 
    }

    function logAgrolyitic($id,$user_id,$verb){
        $cat = Agrolytic::find($id);
        $this->logEntity('Agrolytic',$cat,$user_id,$verb); 
    }

    function reverseHunk(){
      $response = [];  
      $trail = $this;
      $model = $trail->entity;
      $json = $trail->json_data;
      $json = json_decode($json);
      $verb = $trail->verb;

      $model = '\\App\\' . $model;

      $response['message'] = 'Reversal done successfully';

      if ($verb == 'store'){//reverse is delete
        if ( $model::where('id',$json->id)->count() ){
            $model::where('id',$json->id)->delete();
        }else{
            $response['message'] = 'This item is not available for reversal';
        }
      }else if ($verb == 'update'){//reverse is update
        if ( $model::where('id',$json->id)->count() ){
            $updateObj = $model::where('id',$json->id)->first();
            foreach ($json as $k=>$v){
              $updateObj->$k = $v;
            }
            $updateObj->save();                           
        }else{
            $response['message'] = 'This item is not available for reversal';
        }
      }else if ($verb == 'destroy'){//reverse is create
        // if ( $model::where('id',$json->id)->count() ){
            $createObj = new $model;
            foreach ($json as $k=>$v){
              $createObj->$k = $v;
            }
            $createObj->save();                 
        // }else{
        //     $response['message'] = 'This item is not available for reversal';
        // }
      }

    //   $createObj = new $model;
    //   foreach ($json as $k=>$v){
    //     $createObj->$k = $v;
    //   }
    //   $createObj->save(); 
      return $response;
    }


}
