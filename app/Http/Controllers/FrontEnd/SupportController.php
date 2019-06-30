<?php

namespace App\Http\Controllers\FrontEnd;

use App\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function contactUs(Request $request)
    {
        $contact = new Support();
        if (Auth::check()){
            $contact->user_id = Auth::id();
        }
        $contact->name = $request->name;
        $contact->title = $request->title;
        $contact->description = $request->description;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->type = 'contact-us';
        $contact->save();
    }
}
