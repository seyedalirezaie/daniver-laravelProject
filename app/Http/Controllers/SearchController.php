<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getUsers($searchQuery='')
    {

        if(!empty($searchQuery)){
            $users = User::search($searchQuery)->get();
        }else{
            $users = User::get();
        }

        dd($users);

        /*$usersAll = [];
        if (!empty($searchQuery)){

            $queryArray = [];
            array_push($queryArray ,explode(' ' , $searchQuery));

            dd($queryArray);

            foreach ($queryArray as $query){

                $users = User::with('photo' , 'categories')->
                when($searchQuery , function ($q) use($query){
                        $q->where(\DB::raw('concat(name, " ", last_name)'), 'LIKE', "%{$query}%")->orWhere('alias_original' , 'like' , "%".$query."%");

                })
                    ->orderBy('id' , 'DESC')->paginate(15);

            }

        }*/

        $response = [
            'users' => $users
        ];

        return response()->json($response , 200);

    }
}
