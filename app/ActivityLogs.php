<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ActivityLogs extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $collection = 'activity_logs';

    protected $connection = 'mongodb';

    protected $fillable = [
        //'activity_log_id',
        'fire_event',
        'site_id',
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
