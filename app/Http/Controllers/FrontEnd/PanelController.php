<?php

namespace App\Http\Controllers\FrontEnd;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index($userId)
    {
        $user = User
            ::with('places' , 'photo' , 'categories' , 'accounts' , 'posts.category' , 'posts.photos')
            ->whereId($userId)->first();
        return view('frontend.panel.index' , compact(['user']));
    }
}