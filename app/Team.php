<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Team extends Model
{
    public $fillable = [
        'name',
        'city',
        'stadium',
        'players',
    ];
}
