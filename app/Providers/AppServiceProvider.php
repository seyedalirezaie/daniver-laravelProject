<?php

namespace App\Providers;

use App\Category;
use App\User;
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
    }
}
