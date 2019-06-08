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

    protected $appends = ['date' , 'full_date'];

    public function getDateAttribute()
    {
        return \Hekmatinasser\Verta\Verta::instance($this->created_at)->formatDifference();
    }

    public function getFullDateAttribute()
    {
        $v = verta($this->created_at);
        return $v->format('Y-n-j ساعت H:i');
    }
}
