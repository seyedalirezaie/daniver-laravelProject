<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function apiPostComment(Request $request)
    {
        /*dd($request->comment);*/

        $commentText = $request->comment;
        $postId = $request->postId;
        $userId = Auth::id();

        $post = Post::whereId($postId)->first();

        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->description = $commentText;
        if (isset($request->parent_id) && empty($request->parentId)){
            $comment->parent_id = $request->parent_id;
        }

        $post->comments()->save($comment);

    }

}
