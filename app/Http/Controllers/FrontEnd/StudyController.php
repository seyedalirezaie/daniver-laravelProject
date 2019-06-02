<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;

class StudyController extends Controller
{
    public function index()
    {
        $majors = Category::with('childrenRecursive' , 'photo')->withCount(['childrenRecursive'])->whereSort('major')->where('parent_id' , 1)->get();

        return view('frontend.study.index' , compact(['majors']));
    }

    public function college($slug)
    {
        $majors = Category::with('childrenRecursive')->whereSlug($slug)->first();
        return view('frontend.study.college' , compact(['majors']));
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
        return view('frontend.study.posts' , compact(['categoryId' , 'year']));
    }
}