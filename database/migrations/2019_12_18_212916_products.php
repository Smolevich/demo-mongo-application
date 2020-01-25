<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{

    public function up()
    {
        Schema::collection('products', function ($collection) {
            $collection->geospatial('location', '2dsphere');
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}
