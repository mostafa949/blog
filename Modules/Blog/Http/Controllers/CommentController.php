<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        if (auth('admin')->check()) {
            $comment->name = auth('admin')->user()->name;
            $comment->admin_id = auth('admin')->user()->id;
        } elseif (auth()->check()) {
            $comment->name = auth()->user()->name;
            $comment->user_id = auth()->user()->id;
        } else {
            $comment->name = $request->input('name');
        }
        $comment->comment = $request->input('comment');
        $comment->post_id = $request->input('post_id');
        $comment->save();

        return redirect()->back();
    }
}
