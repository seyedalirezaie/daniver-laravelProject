<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Requests\PostFileUploadRequest;
use App\Http\Requests\PostPhotoUploadRequest;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;

class PhotoController extends Controller
{

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function postPhotoUpload(PostFileUploadRequest $request)
    {
        $uploaded_file = $request->file('file');
        $type = $uploaded_file->getClientOriginalExtension();

        $original_name = $uploaded_file->getClientOriginalName();
        $file_name = time() . $this->generateRandomString(4) . $original_name;

        $fileSize = $uploaded_file->getSize();

        $uploaded_file->move('files/', $file_name);

        $photo = new Photo();
        $photo->path = $file_name;
        $photo->original_name = $original_name;
        $photo->size = $fileSize;
        $photo->type = $type;

        $photo->save();

        $file = [ 'id' => $photo->id,
            'original_name' => $photo->original_name,
            'type' => $photo->type];

        return response()->json([
            'file' => $file,
        ]);
    }

    public function apiProfileImage(PostPhotoUploadRequest $request)
    {


        $uploaded_file = $request->file('file');
        $original_name = $uploaded_file->getClientOriginalName();
        $file_name = time() . $this->generateRandomString(4) . $original_name;

        create_thumbnail($uploaded_file, 'images/sm/' . $file_name, 80, 80);
        create_thumbnail($uploaded_file, 'images/md/' . $file_name, 250, 250);

        /*create_thumbnail helper create lower images*/
        /*$uploaded_file->move('images/md' , $file_name);*/

        $photo = new Photo();
        $photo->path = $file_name;
        $photo->original_name = $original_name;
        $photo->save();

        $user = User::findOrFail(Session::get('userId'));
        $user->photo_id = $photo->id;
        $user->save();
        Session::forget('userId');
    }

    public function apiPostImage(Request $request)
    {
        $image = $request->upload;

        $uploaded_file = $image;
        $original_name = $uploaded_file->getClientOriginalName();
        $file_name = time() . $this->generateRandomString(15) . '.jpg';

        $uploaded_file->move('images/lg', $file_name);

        $photo = new Photo();
        $photo->path = $file_name;
        $photo->original_name = $original_name;
        $photo->save();

        $path = '/images/lg/' . $file_name;


        return response()->json(['res' => true , 'url' => $path , 'id' => $photo->id.'-'.$path]);

        }

}
