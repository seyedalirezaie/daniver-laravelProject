<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    public function seenable()
    {
        return $this->morphTo();
    }
}
