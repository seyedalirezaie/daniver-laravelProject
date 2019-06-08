<?php

namespace App\Listeners;

use App\Events\NotificationSeenEvent;
use App\Seen;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class NotificationSeenListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSeenEvent  $event
     * @return void
     */
    public function handle(NotificationSeenEvent $event)
    {

        $notifications = $event->notifications;
        $items = $event->items;

        if ($items == 1){
            $notifications = [$notifications];
        }

        $notify = [];
        foreach ($notifications as $notification){
            if (Arr::has($notification, 'mentionable_id')){
                $seenableId = $notification['id'];
                $seenableType = 'App\Mention';
            }
            if (Arr::has($notification, 'commentable_id')){
                $seenableId = $notification['id'];
                $seenableType = 'App\Comment';
            }
            if (Arr::has($notification, 'accepted')){
                $seenableId = $notification['id'];
                $seenableType = 'App\Friend';
            }
            if (Arr::has($notification, 'message')){
                $seenableId = $notification['id'];
                $seenableType = 'App\Message';
            }
            $notify []  = [
                'user_id'=>Auth::id(),
                'seenable_id'=>$seenableId,
                'seenable_type'=>$seenableType,
            ];
        }

        Seen::insert($notify);
    }
}
