<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    public function commentable()
    {
        return $this->morphTo();
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }

    /*public function post()
    {
        return $this->belongsTo(Post::class);
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class , 'parent_id');
    }

    public function child()
    {
        return $this->replies()->with('child' , 'child.user' , 'child.likes')->withCount(['likes']);
    }

    protected $appends = ['date' , 'liked' , 'full_date'];

    public function getDateAttribute()
    {
        return \Hekmatinasser\Verta\Verta::instance($this->created_at)->formatDifference();
    }

    public function getFullDateAttribute()
    {
        $v = verta($this->created_at);
        return $v->format('Y-n-j ساعت H:i');
    }

    public function getLikedAttribute()
    {
        if (Auth::check()){
            $likes = $this->likes->where('user_id' , Auth::id())->first();

            if (!is_null($likes)){
                return 1;
            } else {
                return 0;
            }

        }
    }

    public function likes()
    {
        return $this->morphMany(Like::class , 'likeable');
    }

    public function seens()
    {
        return $this->morphMany(Seen::class , 'seenable');
    }
}