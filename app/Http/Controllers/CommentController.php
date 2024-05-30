<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post){

        request()->validate([
            'body' => ['required']
        ]);

        $post->comment()->create([
            'user_id' => auth()->id(),
            'body' => request()->input('body')
        ]);
         return redirect()->back();
    }
}
