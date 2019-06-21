<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{

    public function sortGroupsByScores($groups)
    {
        $sortedItems = $groups->sortByDesc(function ($element) {
            return $element['scores'];
        })->values()->take(5);

        foreach ($sortedItems as $key=>$item){
            if ($item->scores == 0){
                unset($sortedItems[$key]);
            }
        }

        return $sortedItems;
    }
    
    public function index()
    {
        $newestUsers = User
            ::with('photo')
            ->orderBy('id' , 'DESC')
            ->where('active' , 1)
            ->where('email_verified_at' , '!=' , null)
            ->where('visible' , 1)
            ->take(25)
            ->get();

        $studyGroups = Category::whereIn('sort' , ['major'])->with('posts' , 'photo')->withCount(['users' , 'posts'])->get();
        $dormGroups = Category::whereIn('sort' , ['dorm'])->with('posts' , 'photo')->withCount(['users' , 'posts'])->get();
        $mateGroups = Category::whereIn('sort' , ['mate'])->with('posts' , 'photo')->withCount(['users' , 'posts'])->get();

        $sortedDorms = $this->sortGroupsByScores($dormGroups);
        $sortedStudies = $this->sortGroupsByScores($studyGroups);
        $sortedMates = $this->sortGroupsByScores($mateGroups);

        $start = Carbon::now()->subDays(7);
        $end = Carbon::now()->toDateTimeString();

        $favoritePosts = Post::with('category' , 'photos' , 'user.photo')->withCount(['likes' , 'comments'])->whereActive(1)->orderBy('likes_count' , 'DESC')->whereBetween('created_at', [$start , $end])->take(5)->get();

        foreach ($favoritePosts as $key=>$post){
            if ($post['likes_count'] == 0){
                unset($favoritePosts[$key]);
            }
        }

        $featuredPosts = Post::with('user.photo' , 'category')->withCount(['likes' , 'comments'])->where('featured' , 1)->where('active' , 1)->get();

        return view('frontend.home.index' , compact(['newestUsers' , 'sortedDorms' , 'sortedStudies' , 'sortedMates' , 'favoritePosts' , 'featuredPosts']));
    }
}
