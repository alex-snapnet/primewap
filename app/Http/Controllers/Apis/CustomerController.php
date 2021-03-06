<?php

namespace App\Http\Controllers\Apis;

use App\User;
use App\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if ($request->filled('return_type')){
            if ($request->return_type == 'count'){
              return [
                  'count'=>Customer::count()
              ]; 
            }else if ($request->return_type == 'all'){
              return CustomerResource::collection(Customer::orderBy('id','desc')->get());
            }else{
              return CustomerResource::collection(Customer::orderBy('id','desc')->paginate(5));
            }   
        }else{
            return CustomerResource::collection(Customer::orderBy('id','desc')->paginate(5));
            // return AgrolyticResource::collection($query->orderBy('id','desc')->paginate(5));
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
    public function store(Request $request,Customer $customer)
    {
        //
        $customer->name = $request->name;
        $customer->contact_email = $request->contact_email;
        $customer->address = $request->address;
        $customer->phone_num = $request->phone_num;
        $customer->added_by = $request->added_by;
        $customer->user_id = $request->user_id;


        if ($customer->save()){
          return new CustomerResource($customer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        return new CustomerResource($customer);
    }

    function showField(Customer $customer){
      return $customer;
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
    public function update(Request $request,Customer $customer)
    {
        //
        $userObj = User::find($request->user_id);
        if ($userObj->canAlterCustomers($customer)){
          $customer->name = $request->name;
          $customer->contact_email = $request->contact_email;
          $customer->address = $request->address;
          $customer->phone_num = $request->phone_num;
          $customer->added_by = $request->added_by;
  
          if ($customer->save()){
             return new CustomerResource($customer);    
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
    public function destroy(Customer $customer,Request $request)
    {
        //
        $userObj = User::find($request->user_id);
        if ($userObj->canAlterCustomers($customer)){
          if ($customer->delete()){
            return new CustomerResource($customer);
          }  
        }else{
          return $userObj->getAccessDeniedError();
        }

    }

    
}
