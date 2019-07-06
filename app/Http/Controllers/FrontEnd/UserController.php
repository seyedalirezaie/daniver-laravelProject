<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Friend;
use App\Like;
use App\Mention;
use App\Message;
use App\Post;
use App\Seen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function apiCheckAuth()
    {
        if (Auth::check()){
            $user = User::with('photo' , 'bookmarks')->whereId(Auth::id())->first();
            return ['auth'=>'yes' , 'user' => $user];
        } else {
            return ['auth'=>'no' , 'user' => ''];
        }
    }

    public function apiCheckCategory($categoryId)
    {
        if (Auth::check()){
            $hasCategory = User::whereId(Auth::id())->with('categories')->whereHas('categories' , function ($q) use ($categoryId){
                $q->where('categories.id' , $categoryId);
            })->exists();

            if (!$hasCategory) {
                return 0;
            } else {
                return 1;
            }

        }
    }

    public function apiSetLastSeen()
    {
        $user = User::findOrFail(Auth::id());
        $user->lastseen = now();
        $user->save();
    }

    public function index()
    {
        return view('frontend.users.index');
    }

    public function users()
    {
        $users = User::with('schools' , 'categories' , 'photo' , 'places.province' , 'places.city' , 'places.subcity' , 'othermajors' , 'accounts')
            ->withCount(['posts'])
            ->get();
    }

    public function getUsers($searchQuery='')
    {


        $users = User::with('categories')
            ->where('active' , 1)
            ->where('email_verified_at' , '!=' , null)
            ->where('visible' , 1)
            ->when($searchQuery != 'no-search' , function ($q) use($searchQuery){
            $q->where(\DB::raw('concat(name, " ", last_name)'), 'LIKE', "%{$searchQuery}%")->orWhere('alias_original' , 'like' , "%".$searchQuery."%")
                ->where('email_verified_at' , '!=' , null);
        })
            ->orderBy('id' , 'DESC')->paginate(15);

        $response = [
            'users' => $users
        ];
        return response()->json($response , 200);
    }

    public function apiAutoLogin(Request $request)
    {
        if ($request->type == 'admin'){
            $userId = 1;
        }
        if ($request->type == 'user'){
            $userId = 112;
        }
        if ($request->type == 'writer'){
            $userId = 100;
        }
        Auth::loginUsingId($userId);
    }


}
