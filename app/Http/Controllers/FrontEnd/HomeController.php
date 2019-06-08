<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    
    public function index()
    {

        /*Role::create(['name' => 'blog-writer' , 'explanation' => 'نویسنده ی وبلاگ']);*/
        /*Permission::create(['name' => 'write post']);*/

        /*$permission2 = Permission::create(['name' => 'edit post']);*/
        /*$permission3 = Permission::create(['name' => 'delete post']);*/

        /*$role = Role::findById(1);*/

        /*$permission = Permission::findById(1);*/
        /*$role->givePermissionTo($permission);*/
        /*$role->givePermissionTo($permission2);*/

        /*$role->syncPermissions($permissions);
        $permission->syncRoles($roles);*/

        /*$permission3->assignRole($role);*/

        /*give permission to user(Model)*/


        /*Permission::whereRaw('1=1')->delete();*/

        /*$role->revokePermissionTo(['write post' , 'edit post' , 'delete post']);*/
        /*$permission->removeRole($role);*/

        /*$user->revokePermissionTo('write post');*/
        /*$user->removeRole('writer');*/

        /*$user->givePermissionTo('write post');*/
        /*$user->assignRole('writer');*/


        /*return $user->permissions;*/
        /*return $user->getPermissionNames();*/
        //return $user->getDirectPermissions();
        //return $user->getPermissionsViaRoles();
        /*return $user->getAllPermissions();*/

        /*return User::role('writer')->get();*/
        /*return User::permission('edit post')->get();*/


        $newestUsers = User
            ::with('photo')
            ->orderBy('id' , 'DESC')
            ->where('active' , 1)
            ->where('email_verified_at' , '!=' , null)
            ->where('visible' , 1)
            ->take(25)
            ->get();

        $bestGroups = Category
            ::whereIn('sort' , ['major' , 'mate' , 'dorm'])
            ->with('posts' , 'photo')
            ->withCount(['users' , 'posts'])
            ->get();

        $sortedItems = $bestGroups->sortByDesc(function ($element) {
            return $element['scores'];
        })->values()->take(5);

        foreach ($sortedItems as $key=>$item){
            if ($item->scores == 0){
                unset($sortedItems[$key]);
            }
        }

        $bestGroupsByScore = $sortedItems;

        return view('frontend.home.index' , compact(['newestUsers' , 'bestGroupsByScore']));
    }
}
