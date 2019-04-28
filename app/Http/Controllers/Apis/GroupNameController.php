<?php

namespace App\Http\Controllers\Apis;

use App\User;
use App\GroupName;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupNameResource;

class GroupNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $query = GroupName::orderBy('id','desc');
        // if ($request->filled('group_name_id')){//group_name_id
        //    $query = $query->where('group_name_id',$request->group_name_id);
        // }

        if ($request->filled('return_type')){
            if ($request->return_type == 'count'){
              return [
                  'count'=>GroupName::count()
              ]; 
            }else if ($request->return_type == 'all'){
              return GroupNameResource::collection(GroupName::orderBy('id','desc')->get());
            }else{
              return GroupNameResource::collection(GroupName::orderBy('id','desc')->paginate(5));
            }   
        }else{
            return GroupNameResource::collection(GroupName::orderBy('id','desc')->paginate(5));
            // return AgrolyticResource::collection($query->orderBy('id','desc')->paginate(5));
        }
        // return GroupNameResource::collection($query->paginate(5));
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
    public function store(Request $request,GroupName $groupname)
    {
        //
        $groupname->name = $request->name;
        $groupname->group_name_id = $request->group_name_id;
        $groupname->user_id = $request->user_id;

        if ($groupname->save()){
          return new GroupNameResource($groupname);
        }

    }

    function storeBulk(Request $request){

        $countRows = 0; 
        $k = -1;
        $bulkRequest = $request->blob;
        
        // dd($bulkRequest);

         foreach ($bulkRequest as $k=>$v){
           $objGroupName = new GroupName;
           $objGroupName->name = $v['name'];
           $objGroupName->user_id = $request->user_id;
           $objGroupName->save(); 
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
    public function show(GroupName $groupname)
    {
        //
        return new GroupNameResource($groupname);
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
    public function update(Request $request,GroupName $groupname)
    {
        //
        $userObj = User::find($request->user_id);
        if ($userObj->canAlterGroup($groupname)){
            $groupname->name = $request->name;
            if ($groupname->save()){
              return new GroupNameResource($groupname);
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
    public function destroy(GroupName $groupname,Request $request)
    {
        //

        $userObj = User::find($request->user_id);
        if ($userObj->canAlterGroup($groupname)){
            if ($groupname->groups()->exists()){
                return [
                    'message'=>'This group already has sub-groups, try deleting the the sub-groups first!',
                    'error'=>true
                ];  
            }else{
                if ($groupname->delete()){
                    return new GroupNameResource($groupname);
                }      
            }    
        }else{
            return $userObj->getAccessDeniedError();
        }



    }


}

