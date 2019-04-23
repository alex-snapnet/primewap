<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
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

        $query = Comment::orderBy('id','desc')->with('user')->with('agrolytic');
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
           return new CommentResource($comment);
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
        $comment->comment = $request->comment;
        // $comment->type = $request->type;
        if ($comment->save()){
           return new CommentResource($comment);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        if ($comment->delete()){
           return new CommentResource($comment); 
        }

    }


}
