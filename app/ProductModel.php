<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductModel extends Model
{
    public $collection = 'products';
    public $connection = 'mongodb';

    public $fillable = [
        'location',
        'category_id',
        'description',
        'location',
        'price',
    ];
}
