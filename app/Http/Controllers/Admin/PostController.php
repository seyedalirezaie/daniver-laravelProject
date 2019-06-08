<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Photo;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function create()
    {
        $categories = Category::with('childrenRecursive')->whereSort('blog')->where('parent_id' , 72)->get();

        $tags = Tag::whereHas('posts.category' , function ($q){
            $q->where('categories.sort' , 'blog');
        })->orderBy('id' , 'DESC')->get();

        return view('admin.blog.create' , compact(['categories' , 'tags']));
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->title = $request->title;
        if ($request->slug){
            $post->slug = make_slug($request->slug);
        } else {
            $post->slug = make_slug($request->title);
        }
        $post->description_preview = nl2br($request->description_preview);
        $post->description = $request->description;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->active = $request->status;
        $post->commentable = $request->commentable;
        $post->user_id = Auth::id();
        $post->category_id = $request->categoryId;
        $post->save();

        if (isset($request->uploadedFiles) && !empty($request->uploadedFiles)) {
            $array = $request->uploadedFiles;
            /*this foreach is just for when user upload files and he can't upload more than 10 files in each post*/
            foreach ($array as $key => $row) {
                if ($key < 10) {
                    Photo::where('id', $row['id'])->update(['original_name' => $row['original_name'], 'post_id' => $post->id]);
                }
            }
        }

        if (isset($request->editorPhotos) && !empty($request->editorPhotos)) {

            $photosIdArray = explode(',', $request->editorPhotos);
            $photosPathArray = explode(',', $request->editorPhotosPath);

            $totalPhotoIds = [];
            foreach ($photosIdArray as $photoIdPath) {
                $array = explode('-', $photoIdPath);
                foreach ($photosPathArray as $photoPath) {
                    if ($photoPath == $array[1]) {
                        array_push($totalPhotoIds, $array[0]);
                    }
                }
            }

            Photo::whereIn('id', $totalPhotoIds)->update(['post_id' => $post->id]);;
        }


        if ($request->tags) {

            $tagIds = [];
            $newTagCodes = [];
            foreach ($request->tags as $tag) {

                if (!isset($tag['id'])) {
                    array_push($newTagCodes, $tag['code']);
                    $newTags[] = [
                        'name' => $tag['name'],
                        'code' => $tag['code'],
                    ];
                } else {
                    array_push($tagIds, $tag['id']);
                }
            }

            /*$newTag = new Tag();*/
            if (isset($newTags) && !empty($newTags)) {
                Tag::insert($newTags);
            }

            $insertedTags = Tag::whereIn('code', $newTagCodes)->pluck('id');

            $totalTagIds = array_merge($tagIds, $insertedTags->toArray());

            $post->tags()->attach($totalTagIds);
        }

        Session::put('postId', $post->id);
        return $post->id;
    }
}

