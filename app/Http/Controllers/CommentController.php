<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Agrolytic;


class CommentController extends Controller
{
    //
    
    function index(Request $request,Agrolytic $agrolytic){
        return view('comment.index',[
            'agrolytic'=>$agrolytic
        ]);
    }

    
}
