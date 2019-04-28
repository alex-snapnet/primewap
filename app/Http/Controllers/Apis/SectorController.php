<?php

namespace App\Http\Controllers\Apis;

use App\User;
use App\Sector;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectorResource;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->filled('return_type')){
            if ($request->return_type == 'count'){
              return [
                  'count'=>Sector::count()
              ]; 
            }else if ($request->return_type == 'all'){
              return SectorResource::collection(Sector::orderBy('id','desc')->get());
            }else{
              return SectorResource::collection(Sector::orderBy('id','desc')->paginate(5));
            }   
        }else{
            return SectorResource::collection(Sector::orderBy('id','desc')->paginate(5));
        }
        
        //

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
    public function store(Request $request,Sector $sector)
    {
        //
        
        $sector->name = $request->name;
        $sector->user_id = $request->user_id;

        if ($sector->save()){
          return new SectorResource($sector);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
        return new SectorResource($sector);
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
    public function update(Request $request,Sector $sector)
    {
        //
        $userObj = User::find($request->user_id);
        if ($userObj->canAlterSectors($sector)){
            $sector->name = $request->name;
            if ($sector->save()){
                return new SectorResource($sector);
            }    
        }else{
            return $userObj->getAccessDeniedError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector,Request $request)
    {
        //
        $userObj = User::find($request->user_id);
        if ($userObj->canAlterSectors($sector)){
            if ($sector->delete()){
                return new SectorResource($sector);
            }      
        }else{
            return $userObj->getAccessDeniedError();
        }
     

    }

}
