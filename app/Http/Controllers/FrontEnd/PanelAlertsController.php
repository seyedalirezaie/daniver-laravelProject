<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Friend;
use App\Mention;
use App\Message;
use App\Post;
use App\Seen;
use App\User;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PanelAlertsController extends Controller
{

    public $audienceMessages;

    public function initialize()
    {

        $postIds = Post::whereHas('user', function ($q) {
            $q->where('user_id', Auth::id());
        })->pluck('id');

        $commentsByPost = Comment::with('seens' , 'child.commentable.category' ,'child.user.photo' , 'user.photo' , 'commentable.category')->where('commentable_type' , 'App\Post')->whereIn('commentable_id', $postIds)->where('user_id' , '!=' , Auth::id())->get();

        $commentsByAnswer = [];
        $commentAnswers = Comment::with('child.seens' , 'child.commentable.category' , 'child.user.photo' , 'user.photo' , 'commentable.category')->where('user_id', Auth::id())->get();

        foreach ($commentAnswers as $comment) {
            foreach ($comment->child as $child)
                if ($child['parent_id'] == $comment['id'] && $child->user_id != Auth::id()) {
                    array_push($commentsByAnswer, $child);
                    Arr::add($child , 'is_answer' , 1);
                }
        }

        $allComments = array_merge($commentsByPost->toArray() , $commentsByAnswer);
        $comments = collect($allComments)->unique('id');

        $postMentions = Mention::with('mentionable.user.photo' , 'mentionable.category' , 'user.photo' , 'seens')->where('mentionable_type' , 'App\post')->where('user_id', Auth::id())->get();
        $commentMentions = Mention::with('mentionable.user.photo' , 'mentionable.commentable.category' , 'user.photo' , 'seens')->where('mentionable_type' , 'App\Comment')->where('user_id', Auth::id())->get();

        $mentions = array_merge($postMentions->toArray() , $commentMentions->toArray());
        $mentions = collect($mentions);

        foreach ($mentions as $key=>$mention){
            if ($mention['mentionable']['user_id'] == Auth::id()){
                unset($mentions[$key]);
            }
        }

        $friendShipAccepts = Friend::with('receiver.photo' , 'seens')->where('sender_id' , Auth::id())->where('accepted' , 1)->get();

        $notifications = array_merge($comments->toArray() , $mentions->toArray(), $friendShipAccepts->toArray());

        $lastWeek = Carbon::now()->subDays(7);
        foreach ($notifications as $key=>$notification){
            foreach ($notification['seens'] as $seen){
                if ($seen['user_id'] == Auth::id()){
                    $notifications[$key]['has_seen'] = 1;
                }
                if ($seen['user_id'] == Auth::id() && Carbon::parse($seen['created_at'])->lessThan($lastWeek)){
                    unset($notifications[$key]);
                }
            }
           /* if (count($notification['seens'])>0 && Carbon::parse($notification['created_at'])->lessThan($start)){

            }*/
        }

        $notifications = collect($notifications);

        $sortedNotification = $notifications->sortByDesc(function ($element) {
            return $element['created_at'];
        })->values()->all();

        /*$sortedNotification = collect($sortedNotification)->slice($page , 10)->all();*/

        return $sortedNotification;

    }

    public function getAudienceMessages($audienceId)
    {
        $this->messages();
        $audiences = $this->audienceMessages;

        foreach ($audiences as $audience){
            if ($audience['audience_id'] == $audienceId){
                return $audience;
            }
        }
    }

    public function messages()
    {
        $messages = Message::with('seens')->where('receiver_id' , Auth::id())->orWhere('sender_id' , Auth::id())->orderBy('id' , 'ASC')->get();
        $audienceMessages = collect($messages)->groupBy('audience.id');


        
        $audienceMessages = $audienceMessages->sortByDesc(function ($element) {
            return $element[sizeof($element) - 1]['created_at'];
        })->values()->all();

        foreach ($audienceMessages as $audience){
            $index = 0;
            foreach ($audience as $message){
                if ($message['sender_id'] != Auth::id() && count($message['seens']) == 0){
                    $index++;
                }
            }
            $audience->put('last_action', $audience[sizeof($audience) - 1]['date']);
            $audience->put('unseen_items', $index++);
            $audience->put('audience_id', $audience[0]['audience']['id']);
        }

        $this->audienceMessages = $audienceMessages;

        $response = [
            'audience' => $audienceMessages,
        ];

        return response()->json($response, 200);
    }

    public function friendRequests()
    {
        $friendRequests = Friend::with('sender.photo' , 'seens')->where('receiver_id' , Auth::id())->where('accepted' , 0)->orderBy('id' , 'DESC')->get();

        foreach ($friendRequests['seens'] as $key=>$seen) {
            if ($seen['user_id'] == Auth::id()) {
                $friendRequests[$key]['has_seen'] = 1;
            }
        }

        return $friendRequests;

        $response = [
            'friendRequests' => $friendRequests,
        ];

        return response()->json($response, 200);

    }

    public function getChat(Request $request)
    {
        $chat = $this->getAudienceMessages($request->audienceId);
        return $chat;
    }
}
