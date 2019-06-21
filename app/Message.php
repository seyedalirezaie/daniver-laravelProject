<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
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

    protected $appends=['full_date' , 'message' , 'audience' , 'date'];

    public function getFullDateAttribute()
    {
        $v = verta($this->created_at);
        return $v->format('Y-n-j ساعت H:i');
    }

    public function getMessageAttribute()
    {
        return '';
    }

    public function getAudienceAttribute()
    {
        if ($this->sender_id == Auth::id()){
            $audience = $this->receiver;
        } elseif ($this->receiver_id == Auth::id()){
            $audience = $this->sender;
        }
        return $audience;
    }

    public function getDateAttribute()
    {
        return \Hekmatinasser\Verta\Verta::instance($this->created_at)->formatDifference();
    }

}
