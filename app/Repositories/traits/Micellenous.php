<?php

namespace App\Repositories\traits;

use Illuminate\Http\Request;
use App\Notifications\UserNotification;

trait Micellenous {



	   public function color($status){
        #00b050;
        switch ($status) {
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
                    return '#ee0000;';
                break;
            default:
                # code...
                break;
        }
    }

    public function notifyuser($user_id, $urltoview,$usermessage){

        $users=\App\User::where('id',$user_id)->get(); 
        // dd($user_id);
        $when=now()->addMinutes(10);
        foreach($users as $user):

            $user->notify((new UserNotification($user->name, $urltoview,$usermessage))->delay($when));
        endforeach;
    }

}