<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->replies()->with('child' , 'child.user');
    }

    protected $appends = ['date' , 'liked'];

    public function getDateAttribute()
    {
        return \Hekmatinasser\Verta\Verta::instance($this->created_at)->formatDifference();
    }

    public function getLikedAttribute()
    {
        return 0;
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
