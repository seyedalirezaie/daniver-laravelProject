<?php

namespace App\Http\Controllers\FrontEnd;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function apiBlogPosts($searchQuery='')
    {

        $posts = Post::with('category' , 'user')
            ->withCount(['comments' , 'likes'])
            ->whereHas('category' , function ($q){
                $q->where('categories.sort' , 'blog');
            })
            ->orderBy('id' , 'DESC')
            ->where('active' , 1)
            ->paginate(6);

        $response = [
            'posts' => $posts
        ];

        return response()->json($response , 200);
    }

    public function post($categorySlug , $postSlug)
    {
        $post = Post::with('category' , 'user.photo' , 'mentions.user.photo' , 'comments.user.photo' , 'likes.user.photo' , 'tags' , 'photos' , 'comments.child.user' , 'comments.likes')
            ->withCount(['comments' , 'likes'])
            ->whereSlug($postSlug)
            ->first();

        $hasFile = 0;
        foreach ($post->photos as $file){
            if ($file->type != ''){
                $hasFile = 1;
            }
        }

        return view('frontend.blog.post' , compact(['post' , 'hasFile']));
    }
}
