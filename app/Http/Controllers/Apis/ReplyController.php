<?php

namespace App\Http\Controllers\Apis;

use App\User;
use App\Reply;

use App\Comment;

use App\Mail\ReplyAltered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ReplyResource;

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

        // Mail;
        // Mail::send();
        // ReplyAltered;

        $this->sendNotification($request->user_id,$request->comment_id,'just replied your comment with : "',$request->content);


        return new ReplyResource($objReply);
        
    }

    function sendNotification($userId,$comment_id,$msg='',$reply){
        $userModifier = User::find($userId);
        $commentObj = Comment::find($comment_id);
        
        $userIdObj = User::find($commentObj->user_id);
        // $opRepObj = User::find($agroObj->op_rep);

        $tos = [$userIdObj->email];
        if (!in_array($userModifier->email,$tos)){
         $tos[] = $userModifier->email;
        }
        $tos[] = 'easymagic1@gmail.com';
        
        foreach ($tos as $to){
         Mail::to($to)->send(new ReplyAltered($userModifier,$msg . $reply . '"'));
        }
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
        $userObj = User::find($request->user_id);
        // dd($userObj);
        if ($userObj->canAlterReplies($reply)){

            $this->sendNotification($request->user_id,$reply->comment_id,'just replied your comment with : "',$request->content);

            $reply->content = $request->content;
            $reply->save();    
        }else{
          return $userObj->getAccessDeniedError();
        }



        return new ReplyResource($reply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply,Request $request)
    {
        //
        $userObj = User::find($request->user_id);
        if ($userObj->canAlterReplies($reply)){
            if ($reply->delete()){
                return new ReplyResource($reply);            
             }
     
            // $reply->content = $request->content;
            // $reply->save();    
        }else{
          return $userObj->getAccessDeniedError();
        }

    }
}
