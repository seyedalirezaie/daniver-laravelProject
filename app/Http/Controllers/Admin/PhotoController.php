<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostPhotoUploadRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PhotoController extends Controller
{

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function apiPostImage(PostPhotoUploadRequest $request)
    {


        $uploaded_file = $request->file('file');
        $original_name = $uploaded_file->getClientOriginalName();
        $file_name = time() . $this->generateRandomString(4) . $original_name;

        create_thumbnail($uploaded_file, 'images/md/' . $file_name, 400, 280 , 'jpeg');
        create_thumbnail($uploaded_file, 'images/sm/' . $file_name, 200, 140 , 'jpeg');

        /*create_thumbnail helper create lower images*/
        /*$uploaded_file->move('images/md' , $file_name);*/

        $photo = new Photo();
        $photo->path = $file_name;
        $photo->original_name = $original_name;
        $photo->post_id = Session::get('postId');
        $photo->save();

        Session::forget('postId');
    }
}
