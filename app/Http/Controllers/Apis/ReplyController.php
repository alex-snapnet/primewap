<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\ReplyResource;

use App\Reply;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Reply::orderBy('id','desc')->with('user');  
        if ($request->has('comment_id')){
            $query = $query->where('comment_id',$request->comment_id);
        }


        $query = $query->with('comment');
        return ReplyResource::collection($query->paginate(5));    

        // if (is_null($query)){
        //     $query = Reply::with('comment');
        //     return ReplyResource::collection($query->paginate(5));                        
        // }else{
        // }

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
        //
        $objReply = new Reply;
        $objReply->comment_id = $request->comment_id;
        $objReply->user_id = $request->user_id;
        $objReply->content = $request->content;
        $objReply->save();

        return new ReplyResource($objReply);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request,Reply $reply)
    {
        //
        $reply->content = $request->content;
        $reply->save();

        return new ReplyResource($reply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
        if ($reply->delete()){
           return new ReplyResource($reply);            
        }
    }
}
