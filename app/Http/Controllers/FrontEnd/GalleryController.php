<?php

namespace App\Http\Controllers\FrontEnd;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function apiHeaderImage(Request $request)
    {
        $this->apiDeleteHeaderImage();

        $uploaded_file = $request->file('file');
        $original_name = $uploaded_file->getClientOriginalName();
        $file_name = time() . $this->generateRandomString(4) . $original_name;

        create_thumbnail($uploaded_file, 'images/lg/' . $file_name, 1048, 349.333);

        /*create_thumbnail helper create lower images*/
        /*$uploaded_file->move('images/md' , $file_name);*/

        $photo = new Gallery();
        $photo->path = $file_name;
        $photo->original_name = $original_name;
        $photo->is_header = 1;
        $photo->user_id = Auth::id();
        $photo->save();


        return ['path' => $photo->path];
    }

    public function apiDeleteHeaderImage()
    {
        $userHeaderPhoto = Gallery::where('user_id' , Auth::id())->where('is_header' , 1)->first();
        if (!is_null($userHeaderPhoto)){
            @unlink('images/lg/'.$userHeaderPhoto->path);
            $userHeaderPhoto->delete();
        }

    }
}
