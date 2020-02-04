<?php

namespace Tests\Unit;

use App\ProductModel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DatabaseMigrationsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $product = new ProductModel();
        $product->location = null;
        $product->category_id = 1;
        $product->description = "test description";
        $product->price = 20.00;

        $product->save();

        $this->assertFalse(is_null($product));
    }
}
