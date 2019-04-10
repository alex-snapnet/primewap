<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\traits\Agrolytic;
use Auth;

class HomeController extends Controller
{
     use Agrolytic;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $agro=$this->miniAgro();
            $agrolytics=\App\Agrolytic::count('id');
            $status=$this->agrolyticsPerformanceReport(0);
            $statusWeek=$this->agrolyticsPerformanceReport(1);
                if(\Auth::user()->type=='prime_osp'){
                    // return redirect('agrolytic/viewAgrolytic');
                    return redirect()->route('agrolytic.index');
                }
            $categories=$category=\App\Category::get();
       return view ('home',compact('agro','status','statusWeek','agrolytics','categories'));
    //    return 'Welcome....';
    }
}
