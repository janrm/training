<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    function team ()
        {
        return this->hasMany('App\Team');
        }
}
