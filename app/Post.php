<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $collection ='posts';
    protected $fillable = [
        'owner_id',
        'group_id',
        'title',
        'content',
        'status',
        'updated_at',
        'created_at',
    ];
}
