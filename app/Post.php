<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable')->withCount('likes');
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

    public function mentions()
    {
        return $this->morphMany(Mention::class , 'mentionable');
    }
}
