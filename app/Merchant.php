<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Merchant extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'post';
    public $fillable = [
        'title',
        'rated',
        'year',
        'imdb'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', '_id');
    }
}
