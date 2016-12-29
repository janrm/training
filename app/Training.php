<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    public function trainer()
    {
        return $this->belongsToMany('App\Trainer');
    }    //
}
