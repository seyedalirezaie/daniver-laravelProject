<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Photo extends Model
{
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function setSizeAttribute($value)
    {
        $sizeKB = $value * 0.00097656;
        $this->attributes['size'] = round($sizeKB);
    }

}
