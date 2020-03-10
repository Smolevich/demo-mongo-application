<?php

namespace App;

use App\Casts\ObjectIDCast;
use App\Casts\UTCDateTimeCast;
use Jenssegers\Mongodb\Eloquent\Model;

class Client extends Model
{
    protected $collection = 'clients';
    protected $casts = [
        'object_id' => ObjectIDCast::class,
        '_id' => ObjectIdCast::class,
        'created_at' => UTCDateTimeCast::class,
        'updated_at' => UTCDateTimeCast::class,
    ];

    protected $fillable = [
        'name',
        'email',
        'object_id',
    ];
}
