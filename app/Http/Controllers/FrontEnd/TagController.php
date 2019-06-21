<?php

namespace App\Http\Controllers\FrontEnd;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function apiTags()
    {
        $tags = Tag::with('posts.category')->whereHas('posts' , function ($q){
            $q->whereHas('category' , function ($q2){
                $q2->where('sort' , 'major');
            });
        })->orderBy('id' , 'DESC')->get();

        $response = [
            'tags' => $tags
        ];

        return response()->json($response , 200);
    }
}
