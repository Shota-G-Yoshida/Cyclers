<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect('/posts/' . $request->post_id);
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/');
    }

}