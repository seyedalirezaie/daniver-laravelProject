<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Like;
use App\Mention;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile($alias_id)
    {
        $is_int = filter_var($alias_id, FILTER_VALIDATE_INT);

        $user = User::with( 'categories' , 'photo' , 'places.province' , 'places.city' , 'places.subcity' , 'othermajors' , 'settings' , 'accounts' , 'header')
            ->withCount(['posts' , 'studyPosts' , 'dormPosts' , 'matesPosts' , 'likes' , 'comments'])
            ->when(isset($is_int) , function ($q) use ($is_int , $alias_id){
                if ($is_int == false){
                    $q->whereAlias($alias_id);
                } else{
                    $q->whereId($alias_id);
                }
            })->first();


        $posts = Post::with('photos' , 'category' , 'comments.user.photo' , 'comments.child.user' , 'comments.likes' , 'likes.user.photo')
            ->withCount(['likes' , 'comments'])
            ->where('user_id' , $user->id)
            ->orderBy('id' , 'DESC')
            ->get();

        $start = Carbon::now()->subDays(7);
        $end = Carbon::now()->toDateTimeString();

        $latestComments = Comment::with('commentable.user.photo' , 'commentable.category' , 'commentable.photos')
            ->where('user_id' , $user->id)
            ->whereBetween('created_at', [$start , $end])
            ->get();

        $latestMentions = Mention::with('mentionable.user.photo' , 'mentionable.category')
            ->where('user_id' , $user->id)
            ->whereBetween('created_at', [$start , $end])
            ->get();

        $actions =$latestMentions->merge($latestComments);

        $sortedActions = $actions->sortByDESC(function ($element) {
            return $element['created_at'];
        })->values()->all();

        $dt = Carbon::now();
        $birthday = $user->birthday;
        $birthday = Carbon::parse($birthday);
        $birthday->year = $dt->year;

        if ($birthday->isPast()){
            $birthday->year = $dt->year + 1;
        }
        $birthday = $birthday->toDateTimeString();

        $receivedLikes = Like::whereIn('likeable_id' , $posts->pluck('id'))->count();
        $receivedComments = Comment::whereIn('commentable_id' , $posts->pluck('id'))->count();

        return view('frontend.profile.index' , compact(['user' , 'posts' , 'sortedActions' , 'birthday' , 'receivedLikes' , 'receivedComments' , 'friendShipStatus']));
    }
}
