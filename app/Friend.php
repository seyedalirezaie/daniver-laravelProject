<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function seens()
    {
        return $this->morphMany(Seen::class , 'seenable');
    }

    protected  $appends=['full_date'];

    public function getFullDateAttribute()
    {
        $v = verta($this->created_at);
        return $v->format('Y-n-j ساعت H:i');
    }
}
