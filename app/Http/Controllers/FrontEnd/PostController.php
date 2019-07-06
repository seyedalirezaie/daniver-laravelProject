<?php

namespace App\Http\Controllers\FrontEnd;

use App\Photo;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use function Composer\Autoload\includeFile;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function checkSlug($slug)
    {
        return Post::where('slug' , $slug)->exists();
    }

    public function generateSlug($string=''){
        $number = mt_rand(100 , 10000);
        $newSlug = $string . '-' . $number;
        if ($this->checkSlug($newSlug)){
            return $this->generateSlug($newSlug);
        }
        return $newSlug;
    }

    public function apiPostStore(Request $request)
    {

        $post = new Post();

        $slug = make_slug($request->title);
        if ($this->checkSlug($slug)){
            $correctSlug = $this->generateSlug($slug);
        } else {
            $correctSlug = $slug;
        }

        $post->title = $request->title;
        $post->slug = $correctSlug;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->category_id = $request->categoryId;
        $post->save();




        if (isset($request->uploadedFiles) && !empty($request->uploadedFiles)){
            $array = $request->uploadedFiles;
            /*this foreach is just for when user upload files and he can't upload more than 10 files in each post*/
            foreach ($array as $key=>$row){
                if ($key < 10) {
                    Photo::where('id', $row['id'])->update(['original_name' => $row['original_name'], 'post_id' => $post->id]);
                }
            }
        }




            if (isset($request->editorPhotos) && !empty($request->editorPhotos)){

                $photosIdArray = explode(',' , $request->editorPhotos);
                $photosPathArray = explode(',' , $request->editorPhotosPath);

                $totalPhotoIds = [];
                foreach ($photosIdArray as $photoIdPath){
                    $array = explode('-' , $photoIdPath);
                    foreach ($photosPathArray as $photoPath){
                        if ($photoPath == $array[1]){
                            array_push($totalPhotoIds , $array[0]);
                        }
                    }
                }

                Photo::whereIn('id' , $totalPhotoIds)->update(['post_id' => $post->id]);;
            }


            if (count($post->photos) > 0){

                foreach ($post->photos as $photo){
                    if ($photo->type == null){
                        $thumbnailPath = $photo->path;
                        create_thumbnail('images/lg/' . $thumbnailPath , 'images/sm/'.$thumbnailPath , 120 , 120 , 'jpeg');
                        /*create_thumbnail2('images/lg/' . $thumbnailPath , 'images/sm/'.$thumbnailPath , 120 , 120);*/

                        $previewPhoto = Photo::findOrFail($photo->id);
                        $previewPhoto->is_preview = 1;
                        $previewPhoto->save();

                        break;
                    }
                }


            }

        if ($request->tags){

            $tagIds = [];
            $newTagCodes = [];
            foreach ($request->tags as $tag){

                if (!isset($tag['id'])){
                    array_push($newTagCodes , $tag['code']);
                    $newTags[] = [
                        'name' => $tag['name'],
                        'code' => $tag['code'],
                    ];
                } else {
                    array_push($tagIds , $tag['id']);
                }
            }

            /*$newTag = new Tag();*/
            if (isset($newTags) && !empty($newTags)){
                Tag::insert($newTags);
            }

            $insertedTags = Tag::whereIn('code' , $newTagCodes)->pluck('id');

            $totalTagIds = array_merge($tagIds , $insertedTags->toArray());

            $post->tags()->attach($totalTagIds);

        }

        return $post->id;



    }

    public function apiSelectPost($postId)
    {
        $post = Post::with('user.photo', 'user.categories' , 'comments.user.photo' , 'comments.child.user' , 'comments.likes' , 'photos' , 'likes.user.photo' , 'tags' , 'mentions.user.photo')->withCount(['likes' , 'comments'])->whereId($postId)->first();

        $response = [
            'post' => $post
        ];

        return response()->json($response , 200);

    }

    public function apiSelectPostBySlug($postSlug , $postItems)
    {
        $post = Post::with('user.photo', 'user.categories' , 'comments.user.photo' , 'comments.child.user' , 'comments.likes' , 'photos' , 'likes.user.photo' , 'tags' , 'mentions.user.photo')->withCount(['likes' , 'comments'])->whereSlug($postSlug)->first();

        $categoryId = $post->category_id;
        $posts = Post::where('category_id' , $categoryId)->orderBy('id' , 'ASC')->pluck('id');
        $postIndex = '';
        foreach ($posts as $key=>$row){
            if ($row == $post->id){
                $postIndex = $key;
            }
        }

        $postDiff = $posts->count() - 1 - $postIndex;
        $page = ceil($postDiff/$postItems);

        $response = [
            'post' => $post,
            'page' => $page
        ];

        return response()->json($response , 200);
    }

    public function apiPosts($categoryId , $query , $searchType='' , $timeFilter , $otherFilters , $orderFilter , $tagFilter , $items=20)
    {


        $type = '';
        $field = '';
        $field1 = '';
        $field2 = '';
        if ($query != 'noSearch'){
            switch ($searchType){
                case 't':
                    $field = 'title';
                    $type = 'one';
                    break;
                case 'd':
                    $field = 'description';
                    $type = 'one';
                    break;
                case 'u':
                    $type = 'user';
                    break;
                case 'td':
                case 'dt':
                    $field1 = 'title';
                    $field2 = 'description';
                    $type = 'two';
                    break;
                case 'tu':
                case 'ut':
                    $field = 'title';
                    $type = 'userByOne';
                    break;
                case 'du':
                case 'ud':
                    $field = 'description';
                    $type = 'userByOne';
                    break;
                case 'tdu':
                case 'tud':
                case 'dut':
                case 'dtu':
                case 'udt':
                case 'utd':
                    $field1 = 'title';
                    $field2 = 'description';
                    $type = 'userByTwo';
            }
        }

        $userYear = '';

        if ($otherFilters == 'mates') {
            if (Auth::check()) {
                $authUser = Auth::user();
                $hasCategory = User::whereId(Auth::id())->with('categories')->whereHas('categories' , function ($q) use ($categoryId){
                    $q->where('categories.id' , $categoryId);
                })->first();


                foreach ($hasCategory->categories as $category){
                    if ($category->id == $categoryId){
                        $userYear = $category->pivot->year;
                    }
                }

                if (empty($hasCategory)){
                    die();
                }
            }
        }



            $posts = Post::with('user.categories')->withCount(['likes' , 'comments'])->orderBy($orderFilter , 'DESC')
                ->when(1==1 , function ($q) use($categoryId){
                    $q->where('category_id' , '=' , $categoryId)->where('active' , 1);
                })
                /*check time filters*/
                ->when($timeFilter != 'all' , function ($q) use ($timeFilter){
                        if ($timeFilter == 'today') {
                            $q->whereDay('created_at', date('d'));
                        } elseif ($timeFilter == 'yesterday'){
                            $q->whereDate('created_at', '=', Carbon::yesterday()->toDateString());
                        } elseif ($timeFilter == 'lastweek'){
                            $start = Carbon::now()->subDays(7);
                            $end = Carbon::now()->toDateTimeString();

                            $q->whereBetween('created_at', [$start , $end]);
                        }
                    /*check other filters*/
                })->when($otherFilters != 'all' , function ($q) use ($otherFilters , $userYear , $categoryId){
                    if ($otherFilters == 'mates'){
                        if (!Auth::check()){
                            die('notMate');
                        } else {
                            $q->whereHas('user', function ($q2) use ($userYear , $categoryId) {
                                $q2->whereHas('categories' , function ($q3) use($userYear , $categoryId){
                                    $q3->where('categories.id' , $categoryId)->where('year' , $userYear);
                                });
                            });

                            /*whereHas('user.categories', function ($q2) use ($userYear) {
                                $q2->with('categories')->whereHas('')
                            });*/
                        }
                    } elseif ($otherFilters == 'special'){
                        die();
                    } elseif ($otherFilters == 'guests'){
                        $q->where('is_guest' , 1);
                    } elseif ($otherFilters == 'endstudy'){

                        $q->whereHas('user', function ($q2) use ($categoryId) {
                            $q2->whereHas('categories' , function ($q3) use($categoryId){
                                $q3->where('categories.id' , $categoryId)->where('status' , 2);
                            });
                        });

                    }

                    else {

                        $q->whereHas('user', function ($q2) use ($otherFilters , $categoryId) {
                            $q2->whereHas('categories' , function ($q3) use($otherFilters , $categoryId){
                                $q3->where('id' , $categoryId)->where('year' , $otherFilters);
                            });
                        });
                    }
                    /*check search place*/
            })
                ->when($tagFilter != 'undefined' , function ($q) use ($tagFilter){
                    $q->whereHas('tags' , function ($q2) use($tagFilter){
                        $q2->where('tags.id' , $tagFilter);
                    });
                })
                ->when($query != 'noSearch' , function ($q) use($query , $type , $categoryId , $field , $field1 , $field2){

                    if ($type == 'one'){
                        $q->where($field , 'like' , "%".$query."%");

                    } elseif ($type == 'two'){
                        $q->where($field1 , 'like' , "%".$query."%")->orWhere($field2 , 'like' , "%".$query."%");

                    } elseif ($type == 'user'){
                        $q->WhereHas('user' , function ($q2) use ($query){
                            $q2->where(\DB::raw('concat(name, " ", last_name)'), 'LIKE', "%{$query}%");
                        });

                    } elseif ($type == 'userByOne'){
                        $q->where($field , 'like' , "%".$query."%")->orWhereHas('user' , function ($q2) use ($query){
                            $q2->where(\DB::raw('concat(name, " ", last_name)'), 'LIKE', "%{$query}%");
                        });

                    } elseif ($type == 'userByTwo'){
                        $q->where($field1 , 'like' , "%".$query."%")->orWhere($field2 , 'like' , "%".$query."%")->orWhereHas('user' , function ($q2) use ($query){
                            $q2->where(\DB::raw('concat(name, " ", last_name)'), 'LIKE', "%{$query}%");
                        });
                    }

                })
                ->paginate($items);


        $response = [
            'posts' => $posts
        ];

        return response()->json($response , 200);

    }
}
