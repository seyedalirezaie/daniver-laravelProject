<?php

namespace App\Http\Controllers\FrontEnd;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getFriends($userId , $searchQuery='')
    {
            $user = User::findOrFail($userId);
            $friends = $user->friends->where('pivot.accepted' , '1');


            if (isset($searchQuery) && !empty($searchQuery)){
                $result = [];
                foreach ($friends->toArray() as $key=>$friend){
                    $family = strtolower($friend['family']);
                    $alias = strtolower($friend['alias_original']);
                    if (strpos($family, strtolower($searchQuery)) !== false or strpos($alias, strtolower($searchQuery)) !== false ) {
                        array_push($result , $friend);
                    }
                }

                $friends = collect($result);
            }

            $friendsCount = $friends->count();


            $response = [
                'users' => $friends,
                'friends_count' => $friendsCount
            ];
            return response()->json($response , 200);
    }

    public function cancelFriendShip(Request $request)
    {
        $friendShipId = $request->friendShipId;
        Friend::findOrFail($friendShipId)->delete();
    }

    public function friendRequest(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $result = $user->friends->where('id' , $request->friendId)->where('pivot.accepted' , '!=' , '-1')->first();

        if (is_null($result)){
            $friend = new Friend();
            $friend->sender_id = Auth::id();
            $friend->receiver_id = $request->friendId;
            $friend->accepted = 0;
            $friend->save();
        }


    }

    public function checkFriendShip(Request $request)
    {
        $user = User::findOrFail($request->userId);

        $friendShipStatus = 'noFriend';

        if (Auth::check()){
            $authedUser = User::findOrFail(Auth::id());
            $allFriends = $authedUser->friends;

            foreach ($allFriends as $friend){
                if ($friend->id == $user->id){
                    $friendShipStatus = $friend->pivot;
                }
            }
        } else {
            $friendShipStatus = 'notAuth';
        }

        return $friendShipStatus;

    }

    public function acceptFriendShip(Request $request)
    {
        $friendRequest = Friend::findOrFail($request->requestId);
        $friendRequest->accepted = 1;
        $friendRequest->save();
    }
}
