<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CategoryResource;
use App\Category;
use Exception;

use App\AuditTrail;

class CategoryController extends Controller
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
                  'count'=>Category::count()
              ]; 
            }else if ($request->return_type == 'all'){
              return CategoryResource::collection(Category::orderBy('id','desc')->get());
            }else{
              return CategoryResource::collection(Category::orderBy('id','desc')->paginate(5));
            }   
        }else{
            return CategoryResource::collection(Category::orderBy('id','desc')->paginate(5));
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
    public function store(Request $request)
    {
        $categoryObject = new Category; 
        //          
        $categoryObject->name = $request->name;

        if ($categoryObject->save()){
          $id = $categoryObject->id;
          (new AuditTrail)->logCategory($id,$request->user_id,'store');  
          return new CategoryResource($categoryObject);             
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return new CategoryResource($category);
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
    public function update(Request $request,Category $category)
    {
        //

        $id = $category->id;
        (new AuditTrail)->logCategory($id,$request->user_id,'update');

        $category->name = $request->name;
        if ($category->save()){
           return new CategoryResource($category);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,Request $request)
    {
        //
        $id = $category->id;
        (new AuditTrail)->logCategory($id,$request->user_id,'destroy');
        if ($category->delete()){
          return new CategoryResource($category);
        }
    }

}
