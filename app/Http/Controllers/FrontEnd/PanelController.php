<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Events\NotificationSeenEvent;
use App\Friend;
use App\Mention;
use App\Message;
use App\Post;
use App\Seen;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class PanelController extends Controller
{

    public function index()
    {

     /*   if (Auth::user()->hasVerifiedEmail()){
            dd('verified2');
        } else {
            Session::put('verified_email' , 0);
            dd('not verified');
        }*/

        $userId = Auth::id();
        $user = User
            ::with('places', 'photo', 'categories', 'accounts', 'posts.category', 'posts.photos')
            ->whereId($userId)->first();
        return view('frontend.panel.index', compact(['user']));
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
        $posts = Post::whereHas('user', function ($q) {
            $q->where('user_id', Auth::id());
        })->pluck('id');

        $commentsByPost = Comment::with('seens' , 'child.commentable.category' ,'child.user.photo' , 'user.photo' , 'commentable.category')->where('commentable_type' , 'App\Post')->whereIn('commentable_id', $posts)->where('user_id' , '!=' , Auth::id())->get();

        /*1 - on comment answer comments*/
        $commentsByAnswer = [];
        $commentAnswers = Comment::with('child.seens' , 'child.commentable.category' , 'child.user.photo' , 'user.photo' , 'commentable.category')->where('user_id', Auth::id())->get();

        foreach ($commentAnswers as $comment) {
            foreach ($comment->child as $child)
                if ($child['parent_id'] == $comment['id'] && $child->user_id != Auth::id()) {
                    array_push($commentsByAnswer, $child);
                }
        }

        $allComments = array_merge($commentsByPost->toArray() , $commentsByAnswer);

        $seens = Seen::whereIn('seenable_id', collect($allComments)->pluck('id'))->get();


        foreach ($seens as $seen) {
            foreach ($allComments as $key => $comment) {
                if ($comment['id'] == $seen['seenable_id']) {
                    unset($allComments[$key]);
                }
            }
        }

        $allUnreadComments = $allComments;

        $unSeenPostMentions = Mention::with('mentionable.user.photo' , 'mentionable.category' , 'user.photo' , 'seens')->where('mentionable_type' , 'App\post')->where('user_id', Auth::id())->doesntHave('seens')->get();
        $unSeenCommentMentions = Mention::with('mentionable.user.photo' , 'mentionable.commentable.category' , 'user.photo' , 'seens')->where('mentionable_type' , 'App\Comment')->where('user_id', Auth::id())->doesntHave('seens')->get();

        $unSeenMentions = array_merge($unSeenPostMentions->toArray() , $unSeenCommentMentions->toArray());
        $unSeenMentions = collect($unSeenMentions);



        foreach ($unSeenMentions as $key=>$mention){
            if ($mention['mentionable']['user_id'] == Auth::id()){
                unset($unSeenMentions[$key]);
            }
        }

        $unSeenFriendShipAccepts = Friend::with('receiver.photo' , 'seens')->where('sender_id' , Auth::id())->where('accepted' , 1)->whereDoesntHave('seens' , function ($q){
            $q->where('seens.user_id' , Auth::id());
        })->get();

        $notifications = array_merge($allUnreadComments, $unSeenMentions->toArray(), $unSeenFriendShipAccepts->toArray());
        $notifications = collect($notifications);

        $sortedNotification = $notifications->sortByDesc(function ($element) {
            return $element['created_at'];
        })->values()->all();


        $unSeenMessages = Message::with('sender.photo')->where('receiver_id' , Auth::id())->whereDoesntHave('seens' , function ($q){
            $q->where('seens.user_id' , Auth::id());
        })->orderBy('id' , 'DESC')->get();

        $unSeenFriendRequests = Friend::with('sender.photo')->where('receiver_id' , Auth::id())->where('accepted' , 0)->whereDoesntHave('seens' , function ($q){
            $q->where('seens.user_id' , Auth::id());
        })->orderBy('id' , 'DESC')->get();


        $response = [
            'notifications' => $sortedNotification,
            'messages' => $unSeenMessages,
            'friendRequests' => $unSeenFriendRequests,
        ];

        return response()->json($response, 200);
    }

    public function readNotifications(Request $request)
    {
        $notifications = $request->notifications;
        $items = $request->items;

        /*$notifications = collect($notifications);*/

        event(new NotificationSeenEvent($notifications , $items));

    }

    public function changeStatusNow(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->status_now = $request->status_now;
        $user->save();
    }

}