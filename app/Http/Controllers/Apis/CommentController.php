<?php

namespace App\Http\Controllers\Apis;

use App\User;
use App\Comment;

use App\Agrolytic;
use App\Mail\CommentAltered;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $query = Comment::orderBy('id','desc')->with('user')->with('agrolytic')->withCount('replies')->with('replies');
        if ($request->has('agro_id') && $request->filled('agro_id')){
          $query = $query->where('agro_id',$request->agro_id);
        }

        return CommentResource::collection($query->paginate(5));
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
    public function store(Request $request,Comment $comment)
    {
        //
        $comment->user_id = $request->user_id;
        $comment->agro_id = $request->agro_id;
        $comment->comment = $request->comment;


        // $comment->type = $request->type;
        if ($comment->save()){

            // $userModifier = User::find($comment->user_id);
            // $agroObj = Agrolytic::find($request->agro_id);
            // $userOpRep = User::find($agroObj->op_rep);
            
            // $userIdObj = User::find($agroObj->user_id);
            // $opRepObj = User::find($agroObj->op_rep);

            // $tos = [$userIdObj->email,$opRepObj->email];
            // if (!in_array($userModifier->email,$tos)){
            //  $tos[] = $userModifier->email;
            // }
            // $tos[] = 'easymagic1@gmail.com';
            
            // foreach ($tos as $to){
            //  Mail::to($to)->send(new CommentAltered($userModifier,'just posted a comment : "' . $comment->comment . '"'));
            // }

            $this->sendNotification($request->user_id,$comment->agro_id,'just posted a comment : "',$comment->comment);
                
           return new CommentResource($comment);
        }

    }

    function sendNotification($userId,$agro_id,$msg='',$comment){
        $userModifier = User::find($userId);
        $agroObj = Agrolytic::find($agro_id);
        
        $userIdObj = User::find($agroObj->user_id);
        $opRepObj = User::find($agroObj->op_rep);

        $tos = [$userIdObj->email,$opRepObj->email];
        if (!in_array($userModifier->email,$tos)){
         $tos[] = $userModifier->email;
        }
        $tos[] = 'easymagic1@gmail.com';
        
        foreach ($tos as $to){
         Mail::to($to)->send(new CommentAltered($userModifier,$msg . $comment . '"'));
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
        return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
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
    public function update(Request $request,Comment $comment)
    {
        //
        // $comment->user_id = $request->user_id;
        // $comment->agro_id = $request->agro_id;
        $userObj = User::find($request->user_id);
        //canAlterComment
        if ($userObj->canAlterComment($comment)){
            
            $this->sendNotification($request->user_id,$comment->agro_id,'just edited the comment : "',$comment->comment);

            $comment->comment = $request->comment;
            // $comment->type = $request->type;
            if ($comment->save()){    
                return new CommentResource($comment);
            }    
            
        }else{
            return [
                'message'=>'You do not have the permission to perform this action?'
            ];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment,Request $request)
    {

        $userObj = User::find($request->user_id);
        //canAlterComment
        if ($userObj->canAlterComment($comment)){
            if ($comment->delete()){

                $this->sendNotification($request->user_id,$comment->agro_id,'just removed the comment : "',$comment->comment);                
                return new CommentResource($comment); 
             }     
        }else{
            return [
                'message'=>'You do not have the permission to perform this action?'
            ];
        }

        //

    }


}
