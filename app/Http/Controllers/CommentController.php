<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\select;

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

    public function like(Comment $comment,Request $request)
    {

        $likedBy = explode(',',$comment->liked_by);
        array_push($likedBy,$comment->user_id);
        $likedBy = implode(',',$likedBy);
        $insert = Comment::find($comment->id);
        $insert->save();
        $insert->increment('like');

            return back()->with('success','liked successfully');
    }
    public function toggleLike(Request $request, $commentId)
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($commentId);

        if ($comment->likes()->where('user_id', $user->id)->exists()) {
            $comment->likes()->detach($user->id);
            return back()->with('error','we couldnt approve your request');
        } else {
            $comment->likes()->attach($user->id);
            return back()->with('success','you liked this comment');
        }
    }

    public function checkIfUserLikedComment($commentId, $userId)
    {
        // Check if the user has already liked the comment
        $exists = \DB::table('likes')
            ->where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->exists();

        // Return a response based on the check
        return true;
    }
}
