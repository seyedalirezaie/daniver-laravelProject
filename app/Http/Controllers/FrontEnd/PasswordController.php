<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Requests\EditPasswordRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(EditPasswordRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
    }
}
