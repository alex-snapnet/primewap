<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = User::orderBy('id','desc');
        if ($request->filled('role')){
           $query = $query->where('type',$request->role);  
        }

        if ($request->has('searchText')){
           $query = $query->whereRaw("email like '%" . $request->searchText . "%' ");
        }

        return UserResource::collection($query->paginate(5));
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
    public function store(Request $request,User $user)
    {
        //
        if (!$this->accountExists($request->email)){
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->type = '';
            if ($this->passwordIsValid($request)){
              $user->password = Hash::make($request->password);
              if ($user->save()){
                return new UserResource($user);
              }else{
                return ['message'=>'Something went wrong!','error'=>false];                 
              }
            }else{
              return ['message'=>'Invalid Password!','error'=>false];                 
            }
        }else{
           return ['message'=>'An account with this e-mail already exists!','error'=>false]; 
        }

    }

    private function passwordIsValid(Request $request){
      return ($request->password == $request->password_confirm && !empty($request->password));
    }

    function changePassword(User $user,Request $request){
      if ($this->passwordIsValid($request)){
         $user->password = Hash::make($request->password);
         if ($user->save()){
           return new UserResource($user);  
         }else{
           return ['message'=>'Something went wrong!','error'=>false];
         }
      }else{
        return ['message'=>'Invalid Password!','error'=>false];                 
      }
    }

    function changeUserName(User $user,Request $request){
      $user->name = $request->name;
      if ($user->save()){
        return new UserResource($user);
      }else{
        return ['message'=>'Something went wrong!','error'=>true];  
      }
    }

    function updateUserRole(User $user,Request $request){
        $allowedTypes = ['prime_admin','prime_osp','prime_super_admin'];
        if (in_array($request->type,$allowedTypes)){
            $user->type = $request->type;
            if ($user->save()){
              return new UserResource($user);
            }else{
              return ['message'=>'Something went wrong!','error'=>true];  
            }               
        }else{
            return ['message'=>'Unsupported role!','error'=>true];  
        }
    }


    function accountExists($email){
        if (User::where('email',$email)->count() > 0){
          return true;    
        }else{
          return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
    public function update(Request $request,User $user)
    {
        //
        $user->name  = $request->name;
        if ($user->save()){
           return new UserResource($user);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if ($user->delete()){
          return new UserResource($user);
        }

    }


}
