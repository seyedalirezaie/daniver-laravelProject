<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected $appends = ['date' , 'liked' , 'photo_preview' , 'full_date' , 'path_sm' , 'path_md' , 'path_lg' , 'bookmarked'];

    public function getDateAttribute()
    {
        return \Hekmatinasser\Verta\Verta::instance($this->created_at)->formatDifference();
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

    public function getBookmarkedAttribute()
    {
        if (Auth::check()) {
            $bookmarks = $this->bookmarks->where('user_id', Auth::id())->first();

            if (!is_null($bookmarks)) {
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

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class , 'bookmarkable');
    }

    public function mentions()
    {
        return $this->morphMany(Mention::class , 'mentionable');
    }

    public function getPhotoPreviewAttribute()
    {
        foreach ($this->photos as $photo){
            if ($photo->is_preview == 1){
                return $photo;
            }
        }
    }

    public function getFullDateAttribute()
    {
        $v = verta($this->created_at);
        return $v->format('Y-n-j ساعت H:i');
    }

    public function getDisplayedAtAttribute($value)
    {
        if (empty($value)){
            return '';
        }
        $v = verta($value);
        return $v->format('Y-n-j ساعت H:i');
    }

    public function previewPhoto()
    {
        if (count($this->photos) > 0){
            foreach ($this->photos as $photo){
                if ($photo['is_preview'] == 1){
                    $path = $photo->path;
                } else {
                    $path = '';
                }
            }
            return $path;
        } else {
            return '';
        }


    }

    public function getPathSmAttribute()
    {
        return $this->totalPath($this->previewPhoto() , 'sm');
    }

    public function getPathMdAttribute()
    {
        return $this->totalPath($this->previewPhoto() , 'md');
    }

    public function getPathLgAttribute()
    {
        return $this->totalPath($this->previewPhoto() , 'lg');
    }

    public function totalPath($path , $type)
    {
        if (empty($path)){
            $totalPath = \Constants::$img['post_profile'];
            return $totalPath;
        }

        switch ($type){
            case 'sm':
                $totalPath = '/images/sm/'.$path;
                break;
            case 'md':
                $totalPath = '/images/md/'.$path;
                break;
            case 'lg':
                $totalPath = '/images/lg/'.$path;
                break;
        }

        return $totalPath;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = htmlspecialchars($value);
    }

    public function getDescriptionAttribute($value)
    {
        return htmlspecialchars_decode($value);
    }
}
