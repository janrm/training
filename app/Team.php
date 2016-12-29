<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    function season () 
	{
	return this->hasMany('App\Season');
	}
}
