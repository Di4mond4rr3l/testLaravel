<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'user_id' => 'required|gte:0'
        ],
        [
            'user_id' => 'Inserisci user id'
        ]
    );
        if($validator->fails())
            return response()->json([$validator->errors()], 500);


        $comment = new Comment();
        $comment->text = $request->post('text');
        $comment->user_id = $request->post('user_id');
        $comment->post_id = $request->post('post_id');

        try {
            $comment->save();
        }
        catch(Exception $e) {
            \Log::error('Query fallita');
            return response()->json([$e->getMessage()], 500);
        }
        

        return $comment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
