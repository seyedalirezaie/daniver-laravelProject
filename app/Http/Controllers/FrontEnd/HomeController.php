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
        $studyGroups = Category::whereIn('sort' , ['major'])->with('posts' , 'photo')->withCount(['users' , 'posts'])->get();
        $dormGroups = Category::whereIn('sort' , ['dorm'])->with('posts' , 'photo')->withCount(['users' , 'posts'])->get();
        $mateGroups = Category::whereIn('sort' , ['mate'])->with('posts' , 'photo')->withCount(['users' , 'posts'])->get();

        $sortedDorms = $this->sortGroupsByScores($dormGroups);
        $sortedStudies = $this->sortGroupsByScores($studyGroups);
        $sortedMates = $this->sortGroupsByScores($mateGroups);

        return view('frontend.home.index' , compact(['sortedDorms' , 'sortedStudies' , 'sortedMates']));
    }
}
