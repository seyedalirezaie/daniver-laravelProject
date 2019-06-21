<?php

namespace App\Http\Controllers\FrontEnd;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->description = $request->description;
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->audienceId;
        $message->save();
    }
}
