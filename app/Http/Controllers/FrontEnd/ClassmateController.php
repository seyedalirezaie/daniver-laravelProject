<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassmateController extends Controller
{
    public function index()
    {
        $majors = Category::with('childrenRecursive' , 'photo')->withCount(['childrenRecursive'])->whereSort('mate')->where('parent_id' , 4)->get();

        $majors = $majors->sortByDesc(function ($element) {
            return $element['date_posts'];
        })->values()->all();

        return view('frontend.classmates.index' , compact(['majors']));
    }

    public function college($slug)
    {
        $major = Category::with('childrenRecursive' , 'photo')->whereSlug($slug)->first();

        $majorTitle = $major->title;

        $majors = $major->childrenRecursive;

        $majors = $majors->sortByDesc(function ($element) {
            return $element['latest_action'];
        })->values()->all();

        return view('frontend.classmates.college' , compact(['majors' , 'majorTitle']));
    }

    public function posts($slug)
    {

        $verta = \verta();
        $month = $verta->month;
        $year = $verta->year;
        if ($month < 6){
            $year--;
        }

        $category = Category::whereSlug($slug)->first();
        $categoryId = $category['id'];
        return view('frontend.posts.posts' , compact(['categoryId' , 'year']));
    }
}
