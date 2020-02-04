<?php

namespace Tests\Unit;

use App\ProductModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefreshDatabaseTest extends TestCase
{
    use RefreshDatabase;
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
