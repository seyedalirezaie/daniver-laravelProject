<?php

namespace App\Http\Controllers\FrontEnd;

use App\Bookmark;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function apiBookmarkPost(Request $request){
        $postId = $request->postId;
        $post = Post::findOrFail($postId);

        $postBookmark = $post->bookmarks->where('user_id' , Auth::id())->first();

        if (is_null($postBookmark)){
            $bookmark = new Bookmark();
            $bookmark->user_id = Auth::id();
            $post->bookmarks()->save($bookmark);
        }else{
            $postBookmark->delete();
        }

    }
}
