<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExcelServiceController extends Controller
{
    //

    private $delimiter = 'data:application/vnd.ms-excel;base64,';

    function blobToJson(Request $request){
        //data:application/vnd.ms-excel;base64,

         return [
            'message'=>'Touch Down.',
            'binary'=>$this->decodeExcelRawData($request->blob)
         ];
    }


    private function decodeExcelRawData($raw){
      $r = explode($this->delimiter,$raw);
    //   dd($r);
    // echo count($r);
    // dd($r);
      if (count($r) > 1 && empty($r[0]) ){
        $r = $r[1];
        $binary = base64_decode($r);
        $bin = [];
        $binary = explode("\n",$binary);
        foreach ($binary as $bin_){
           $bin[] = str_getcsv($bin_); 
        }
        unset($bin[count($bin) - 1]);

        $columns = $bin[0];
        
        unset($bin[0]);
        $data = [];
        $refined = [];

        foreach ($bin as $bin_){
          foreach ($columns as $k=>$col){
             $data[$col] = $bin_[$k];
          }  
         $refined[] = $data;
         $data = []; //reset data here. 
        }
        return $refined;
      }else{
          return [];
      }

    }

}
