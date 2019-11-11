<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class TestModel extends Model
{
    public $collection = 'test';
    public $connection = 'mongodb';
    public $fillable = [
        'name'
    ];
}
