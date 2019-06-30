<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.layout.master' , function ($view){

            $majors = Category::with('childrenRecursive')->whereSort('major')->where('parent_id' , 1)->get();
            $dorms = Category::whereSort('dorm')->where('parent_id' , 2)->get();
            $classmatesMajors = Category::with('childrenRecursive')->whereSort('mate')->where('parent_id' , 4)->get();
            $user = User::with('photo')->whereId(Auth::id())->first();
            $allRoles = Role::pluck('name')->toArray();

            $view->with(['majors' => $majors , 'dorms' => $dorms , 'user' => $user , 'allRoles' => $allRoles , 'classmatesMajors' => $classmatesMajors]);
        });

        view()->composer(['frontend.home.index', 'frontend.blog.post'], function ($view) {

            $newestUsers = User
                ::with('photo')
                ->orderBy('id' , 'DESC')
                ->where('active' , 1)
                ->where('email_verified_at' , '!=' , null)
                ->where('visible' , 1)
                ->take(25)
                ->get();

            $start = Carbon::now()->subDays(7);
            $end = Carbon::now()->toDateTimeString();

            $favoritePosts = Post::with('category' , 'photos' , 'user.photo')->withCount(['likes' , 'comments'])->whereActive(1)->orderBy('likes_count' , 'DESC')->whereBetween('created_at', [$start , $end])->take(5)->get();

            foreach ($favoritePosts as $key=>$post){
                if ($post['likes_count'] == 0){
                    unset($favoritePosts[$key]);
                }
            }

            $featuredPosts = Post::with('user.photo' , 'category')->withCount(['likes' , 'comments'])->where('featured' , 1)->where('active' , 1)->get();

            $view->with(['newestUsers' => $newestUsers , 'favoritePosts' => $favoritePosts , 'featuredPosts' => $featuredPosts]);
        });
    }
}
