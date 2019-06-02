<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.users.index' , compact(['roles']));
    }

    public function users($query , $items=40)
    {
        $users = User::with('categories' , 'photo' , 'roles')->withCount(['posts'])->get();

        $response = [
            'users' => $users
        ];

        return response()->json($response , 200);
    }

    public function permissions($userId)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user = User::with('roles' , 'permissions')->whereId($userId)->first();

        return view('admin.users.roles_permissions' , compact(['roles' , 'permissions' , 'user']));
    }

    public function storePermissions(Request $request , $userId)
    {
        $user = User::findOrFail($userId);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->back();
    }
}
