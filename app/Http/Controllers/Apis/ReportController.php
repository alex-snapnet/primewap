<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\ReportResource;
use App\Report;

use App\Agrolytic;

use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Report::orderBy('id','desc')->with('user')->with('agrolytic');
        
        if ($request->has('agro_id')){
          $query = $query->where('agro_id',$request->agro_id);
        }
        
        if ($request->filled('date_from') && $request->filled('date_to')){ //date range search
            $query = $query->whereDate('created_at','>=',$request->date_from);
            $query = $query->whereDate('created_at','<=',$request->date_to);
        }


        if ($request->filled('date_days')){
            $now = Carbon::now();
            $pastDays = Carbon::now()->subDays($request->date_days * 1); //$request->date_days * 1
 
         //    echo $now . '<br />';
         //    echo $pastDays;
 
            $query = $query->whereDate('created_at','>=',$pastDays);
            $query = $query->whereDate('created_at','<=',$now); 
        }

        if ($request->filled('status')){
           $query = $query->where('status',$request->status);
        }
 
        if ($request->filled('prog_status')){
            $query = $query->where('prog_status',$request->prog_status);
        }
 

        if ($request->filled('return_type')){
            if ($request->return_type == 'count'){
              return [
                  'count'=>$query->count()
              ]; 
            }else if ($request->return_type == 'all'){
              return ReportResource::collection($query->orderBy('id','desc')->get());
            }else{
              return ReportResource::collection($query->orderBy('id','desc')->paginate(5));
            }   
          }else{
            return ReportResource::collection($query->orderBy('id','desc')->paginate(5));            
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Report $report)
    {
        //
        $report->report = $request->report;
        $report->user_id = $request->user_id;
        $report->agro_id = $request->agro_id;
        $report->notes = $request->notes;
        // $report->status = $request->status;
        // $report->day_week =  date('Y-m-d'); //2018-07-27
        // $report->prog_status = $request->prog_status;
        // $report->report = $request->report;


        if ($report->save()){
            $this->updateAgrolyticWithRecentReport($report);
            return new ReportResource($report);
        }else{
            return [
                'message'=>"Something went wrong!",
                'error'=>true
            ];
        }
    }

    private function updateAgrolyticWithRecentReport(Report $report){
       $agrolyticObj = Agrolytic::find($report->agro_id);
       $agrolyticObj->recomputeProgress(); // = $report->status;
    //    $agrolyticObj->prog_status = $report->prog_status;
    //    $agrolyticObj->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
        return new ReportResource($report);
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
    public function update(Request $request,Report $report)
    {
        //

        if ($request->filled('report'))$report->report = $request->report;
        if ($request->filled('done'))$report->done = $request->done;
        // $report->user_id = $request->user_id;
        // $report->agro_id = $request->agro_id;
        // $report->status = $request->status;
        // $report->day_week =  date('Y-m-d'); //2018-07-27
        if ($request->filled('notes'))$report->notes = $request->notes;


        if ($report->save()){
           $this->updateAgrolyticWithRecentReport($report);
           return new ReportResource($report);
        }else{
           return [
               'message'=>'Something went wrong!',
               'error'=>true
           ]; 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report,Request $request)
    {
        //
        $report->delete();
        $this->updateAgrolyticWithRecentReport($report);
        return $this->index($request);

    }
}
