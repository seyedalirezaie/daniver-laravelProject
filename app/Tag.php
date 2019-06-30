<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name' , 'code'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    protected $appends = ['date'];

    public function getDateAttribute()
    {
        return \Hekmatinasser\Verta\Verta::instance($this->created_at)->formatDifference();
    }
}
