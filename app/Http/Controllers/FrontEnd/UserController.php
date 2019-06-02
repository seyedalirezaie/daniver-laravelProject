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
            $user = User::with('photo')->whereId(Auth::id())->first();
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

    public function search(Request $request)
    {
        if($request->has('search')){
            $users = User::search($request->get('search'))->get();
        }else{
            $users = User::get();
        }
        return view('index', compact('users'));
    }

    public function initNotifications()
    {

        /*
        1 - unread comments
        2 - unread messages
        3 - unread friend requests
        4 - unread mentions
        */

        /*1 - on post comments*/
        $posts = Post::whereHas('user' , function ($q){
            $q->where('user_id' , Auth::id());
        })->pluck('id');

        $commentsByPost = Comment::with('child')->whereIn('commentable_id' , $posts)->get();
        $seens = Seen::whereIn('seenable_id' , $commentsByPost->pluck('id'))->pluck('seenable_id');

        foreach ($seens as $seen){
            foreach ($commentsByPost as $key => $comment){
                if ($comment->id == $seen){
                    unset($commentsByPost[$key]);
                }
            }
        }

        /*1 - on comment answer comments*/
        $commentAnswers = Comment::with('child')->where('user_id' , Auth::id())->get();

        foreach ($commentAnswers as $comment){
            foreach ($comment->child() as $child)
            if ($child->parent_id == $child->id){
                array_push($commentsByPost , $comment);
            }
        }

        return $commentsByPost;



        $comments = [];



        $mentions = Mention::with('mentionable' , 'user.photo')->where('user_id' , Auth::id())->whereSeen(0)->get();
        $friendAnswers = Friend::with('sender.photo')->where('receiver_id' , Auth::id())->where('accepted' , '!=' ,0)->whereSeen(0)->get();

        $notifications = array_merge($comments , $mentions->toArray() , $friendAnswers->toArray());
        $notifications = collect($notifications);

        $sortedNotification = $notifications->sortByDesc(function ($element) {
            return $element['created_at'];
        })->values()->all();

        $messages = Message::with('sender.photo')->where('receiver_id' , Auth::id())->whereSeen(0)->get();
        $friendRequests = Friend::with('sender.photo')->where('receiver_id' , Auth::id())->where('accepted' , 0)->whereSeen(0)->get();

        $response = [
            'notifications' => $sortedNotification,
            'messages' => $messages,
            'friendRequests' => $friendRequests,
        ];

        return response()->json($response , 200);
    }
}
