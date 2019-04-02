<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agrolytic extends Model
{
    //
    protected $fillable=['pag_objective','prospect','status','initiative','user_id','op_rep','day_of_week','comp_objective','cat_id','prog_status','lmodified_id'];

    public function user(){
    	return $this->belongsTo('App\User','user_id')->withDefault();
    }
    public function oprep(){
    	return $this->belongsTo('App\User','op_rep')->withDefault();
    }

    public function report(){
        return $this->hasMany('App\Report','agro_id');
    }

    public function reports(){
        return $this->hasMany(Report::class,'agro_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'agro_id');
    }


    public function customer(){
        return $this->belongsTo('App\Customer','prospect','name')->withDefault();
	}
	
	function clientCustomer(){
		return $this->belongsTo(Customer::class,'customer_id');
	}

    public function lmodified(){
        return $this->belongsTo('App\User','lmodified_id')->withDefault();
    }
    public function category(){
    	return $this->belongsTo('App\Category','cat_id')->withDefault();
	}

	function sector(){
		return $this->belongsTo(Sector::class,'sec_id');
	}
	
	function group(){
		return $this->belongsTo(GroupName::class,'group_name_id');
	}
       
    public function getStatusColorAttribute(){
    	#00b050;
    	switch ($this->status) {
    		case 'Perpetual':
    			# code...
    				return '#00b050;';
    			break;
    		case 'Purchase':
    			# code...
    				return '#0070c0;';
    			break;
    		case 'Pipeline':
    			# code...
    				return '#ffff00;';
    			break;
    		case 'Prospect':
    				return '#c0514d;';
    			# code...
    			break;
    		case 'Present':
    			# code...
    				return '#c0514d;';
    			break;
    		default:
    			# code...
    			break;
    	}
    }
}
