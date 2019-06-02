<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Like;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function apiDoLike(Request $request)
    {
        $likedId = $request->id;
        $postId = $request->postId;
        $userId = Auth::id();


        if ($request->type === 'post'){
            $likedType = Post::whereId($likedId)->first();
        } elseif ($request->type === 'comment'){
            $likedType = Comment::whereId($likedId)->first();
        }

        $userLike = $likedType->likes->where('user_id' , $userId)->first();
        if (is_null($userLike)) {
            $like = new Like();
            $like->user_id = $userId;
            $likedType->likes()->save($like);
        } else {
            $userLike->delete();
        }
    }
}
