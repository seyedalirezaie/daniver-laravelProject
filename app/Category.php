<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{
    public $timestamps = false;

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive')->withCount(['posts' , 'users'])->with('posts');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->withCount(['comments' , 'likes']);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('year' , 'status');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    protected $appends = ['titles' , 'subposts' , 'subusers' , 'dateposts' , 'url' , 'scores'];

    public function getTitlesAttribute()
    {
        if ($this->sort == 'major'){
            if ($this->type == 1){
                return $this->title . ' - کارشناسی';
            } elseif ($this->type == 2){
                return $this->title . ' - کارشناسی ارشد';
            } elseif ($this->type == 3){
                return $this->title . ' - دکتری';
            } else {
                return $this->title;
            }
        } elseif ($this->sort == 'dorm'){
            if ($this->type == 1){
                return 'خوابگاه پسرانه ' . $this->title;
            } elseif ($this->type == 2){
                return 'خوابگاه دخترانه ' . $this->title;
            } else {
                return $this->title;
            }
        } else {
            return $this->title;
        }
    }

    public function getUrlAttribute()
    {
        if ($this->sort == 'major'){
            return 'study';
        } elseif ($this->sort == 'dorm'){
            return 'dormitory';
        } elseif ($this->sort == 'mate') {
            return 'classmates';
        }
    }

    public function getSubpostsAttribute()
    {
        $allPosts = 0;
        foreach ($this->childrenRecursive as $child){
            $allPosts = $allPosts + $child->posts_count;
        }
        return $allPosts;
    }

    public function getSubusersAttribute()
    {
        $allUsers = 0;
        foreach ($this->childrenRecursive as $child){
            $allUsers = $allUsers + $child->users_count;
        }
        return $allUsers;
    }

    public function getDatepostsAttribute()
    {
        $startWeek = Carbon::now()->subDays(7);
        $startMonth = Carbon::now()->subDays(30);
        $now = Carbon::now()->toDateTimeString();
        $todayPosts = 0;
        $thisWeekPosts = 0;
        $thisMonthPosts = 0;
        foreach ($this->childrenRecursive as $child){
            foreach ($child->posts as $post){
                if ($post->created_at->isToday()){
                    $todayPosts ++;
                }
                if ($post->created_at->between($startWeek, $now)){
                    $thisWeekPosts ++;
                }
                if ($post->created_at->between($startMonth, $now)){
                    $thisMonthPosts ++;
                }
            }

        }
        $datePosts = [$todayPosts , $thisWeekPosts , $thisMonthPosts];
        return $datePosts;
    }

    public function getScoresAttribute()
    {
        $postsCount = $this->posts_count;
        $membersCount = $this->users_count;
        $likesCount = 0;
        $commentsCount = 0;
        foreach ($this->posts as $post){
            $likesCount = $likesCount + $post->likes_count;
            $commentsCount = $commentsCount + $post->comments_count;
        }

        if ($membersCount != 0){
            $score = (($postsCount * 25) + ($commentsCount * 3) + ($likesCount * .1))/$membersCount;
        } else {
            $score = 0;
        }


        return $score;
    }
}