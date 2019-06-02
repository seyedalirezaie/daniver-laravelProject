<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    public function mentionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seens()
    {
        return $this->morphMany(Seen::class , 'seenable');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Hekmatinasser\Verta\Verta::instance($value)->formatDifference();
    }
}
