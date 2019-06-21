<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DormitoryController extends Controller
{
    public function index()
    {
        $dorms = Category::dorms();
        return view('frontend.dormitory.index' , compact(['dorms']));
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
