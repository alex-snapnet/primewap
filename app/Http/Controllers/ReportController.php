<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agrolytic;

class ReportController extends Controller
{
    //
    function index(Agrolytic $agrolytic){
        return view('report/index',[
            'agrolytic'=>$agrolytic
        ]);
    }


    function globalIndex(){
        return view('report/global_index');
    }
}
