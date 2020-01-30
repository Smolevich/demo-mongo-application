<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment';
    public $fillable = [
        'title',
        'author',
        'post_id',
    ];
}
