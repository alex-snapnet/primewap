<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\AgrolyticResource;
use App\Agrolytic;
use Auth;

use Carbon\Carbon;

class AgrolyticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $now = Carbon::now();
        // $pastDays = $now->subDays(5); //$request->date_days * 1
        // return $now->format('Y M d h:i:s A');
        //
        
        $query = Agrolytic::with('clientCustomer')->with('reports')->with('comments')->with('oprep');
        
        if ($request->filled('user_id')){
           $query = $query->where('user_id',$request->user_id);  
        }
        
        if ($request->filled('op_rep')){
            $query = $query->where('op_rep',$request->op_rep);  
        }

        if ($request->filled('cat_id')){
           $query = $query->where('cat_id',$request->cat_id);
        //    echo 'cat_id query.';
        }

        if ($request->filled('sec_id')){
           $query = $query->where('sec_id',$request->sec_id);
        }

        if ($request->filled('date_from') && $request->filled('date_to')){ //date range search
          $query = $query->whereDate('created_at','>=',$request->date_from);
          $query = $query->whereDate('created_at','<=',$request->date_to);
        }

        if ($request->filled('date_days')){
           $now = Carbon::now();
           $pastDays = Carbon::now()->subDays($request->date_days * 1); //$request->date_days * 1

           $query = $query->whereDate('created_at','>=',$pastDays);
           $query = $query->whereDate('created_at','<=',$now); 
        }


        if ($request->filled('progress')){

            $i = $request->progress;
            $i = $i * 1;  

            $hi = 0;
            $low = 0;
    
            if ($i == 10){
             $low = 0;
             $hi = $i;   
            }else{
             $low = $i - 10;
             $hi = $i;   
            }
    
            $query = $query->where('prog_status','>=',$low)->where('prog_status','<=',$hi);    

        }           


        // echo $query->toSql();

        $recordsPerPage = 7;

        if ($request->filled('return_type')){
          if ($request->return_type == 'count'){
            return [
                'count'=>$query->count()
            ]; 
          }else if ($request->return_type == 'all'){
            return AgrolyticResource::collection($query->orderBy('id','desc')->get());
          }else{
            return AgrolyticResource::collection($query->orderBy('id','desc')->paginate($recordsPerPage));
          }   
        }else{
          return AgrolyticResource::collection($query->orderBy('id','desc')->paginate($recordsPerPage));
        }
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $this->store();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Agrolytic $agrolytic)
    {
        //
        $agrolytic->group_name_id = $request->group_name_id;
        $agrolytic->pag_objective = $request->pag_objective;
        $agrolytic->cat_id = $request->cat_id;
        $agrolytic->sec_id = $request->sec_id;
        $agrolytic->customer_id = $request->customer_id;
        $agrolytic->prospect = $request->prospect;
        $agrolytic->comp_objective = $request->comp_objective;
        $agrolytic->initiative = $request->initiative;
        $agrolytic->user_id = $request->user_id; //Auth::user()->id;
        $agrolytic->op_rep = $request->op_rep;
        $agrolytic->status = $request->status;

        // $agrolytic->day_of_week = $request->day_of_week;
        // $agrolytic->prog_status = $request->prog_status;
        // $agrolytic->lmodified_id = $request->lmodified_id;

        if ($agrolytic->save()){
           return new AgrolyticResource($agrolytic);
        }

    }


    function storeBulk(Request $request){

        $countRows = 0; 
        $k = -1;
        $bulkRequest = $request->blob;
        
        // dd($bulkRequest);

         foreach ($bulkRequest as $k=>$v){
         
           $agrolytic = new Agrolytic;
           
        //    $agrolytic->group_name_id = $v['group_name_id']; // $request->group_name_id;
           $agrolytic->pag_objective = $v['pag_objective']; //$request->pag_objective;
           $agrolytic->cat_id = $v['cat_id']; //$request->cat_id;
           $agrolytic->sec_id = $v['sec_id']; //$request->sec_id;
           $agrolytic->customer_id = $v['customer_id']; //$request->customer_id;
           $agrolytic->prospect = $v['prospect']; //$request->prospect;
           $agrolytic->comp_objective = $v['comp_objective']; //$request->comp_objective;
           $agrolytic->initiative = $v['initiative']; //$request->initiative;
           $agrolytic->user_id =  $request->user_id; //Auth::user()->id;
        //    $agrolytic->date_created = date('Y-m-d h:i:s');
        //    $agrolytic->op_rep = $v['op_rep']; //$request->op_rep;
        //    $agrolytic->status = $v['status']; //$request->status;
   
           $agrolytic->save(); 

         }

       $countRows = $k + 1;
       
       return [
           'message'=>'Processed ' . $countRows . ' - Rows.'
       ];


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Agrolytic $agrolytic)
    {
        //
        return new AgrolyticResource($agrolytic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Agrolytic $agrolytic)
    {

        $agrolytic->group_name_id = $request->group_name_id;
        $agrolytic->pag_objective = $request->pag_objective;
        $agrolytic->cat_id = $request->cat_id;
        $agrolytic->sec_id = $request->sec_id;
        $agrolytic->status = $request->status;
        $agrolytic->customer_id = $request->customer_id;
        $agrolytic->prospect = $request->prospect;
        $agrolytic->comp_objective = $request->comp_objective;
        $agrolytic->initiative = $request->initiative;
        $agrolytic->user_id = $request->user_id; //Auth::user()->id;
        $agrolytic->op_rep = $request->op_rep;


        if ($agrolytic->save()){
            return new AgrolyticResource($agrolytic);
        }

    }


    public function assignToOpRep(Request $request,Agrolytic $agrolytic)
    {

        $agrolytic->op_rep = $request->op_rep;

        if ($agrolytic->save()){
            return new AgrolyticResource($agrolytic);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agrolytic $agrolytic)
    {
        //
        if ($agrolytic->delete()){
           return new AgrolyticResource($agrolytic);
        }
    }


    function report($week=0){
        
        $process=['Perpetual','Purchase','Pipeline','Prospect','Present'];
        $allAgro = Agrolytic::where('id','<>',0);

        if ($week==1){
            $allAgro=$allAgro->whereBetween('updated_at',[date('Y-m-d',strtotime('-6 days')),date('Y-m-d',strtotime('+1 days'))]);
        }
        $allAgro=$allAgro->count('id');
        $status=[];

        foreach($process as $process){
            $pCOunt = Agrolytic::where('status',$process);
            if($week==1){
                $pCOunt=$pCOunt->whereBetween('updated_at',[date('Y-m-d',strtotime('-6 days')),date('Y-m-d',strtotime('+1 days'))]);
            }
            $pCOunt=$pCOunt->count('id');
            if($allAgro==0){
               $status[$process]=0;
            }else{
               $status[$process]=round(($pCOunt/$allAgro)*100,2);
            }
        }

        return $status;

    }


    function getStatusReport(Request $request){

    	$data=[];

    	for ($i=0; $i<=100; $i+=10){

    		$data[] = $this->countProgress($i,$request->user_id);

    	}

    	return  $data;

    	   	    // var  data: [{x:'2016-12-25', y:20}, {x:'2016-12-26', y:10}]

    }


    private function countProgress($i,$user_id){

        // $i = ( $i == "0" ? ['Pending',$i] : [$i] );
        
        $hi = 0;
        $low = 0;

        if ($i == 10){
         $low = 0;
         $hi = $i;   
        }else{
         $low = $i - 10;
         $hi = $i;   
        }

        // dd(Auth::user());
        $query = Agrolytic::where('prog_status','>=',$low)->where('prog_status','<=',$hi)->where('user_id',$user_id);

    	return $query->count('id');

    }
    




}
