<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    public function trainers()
    {
        return $this->belongsToMany('App\Trainer');
    }    //
}
