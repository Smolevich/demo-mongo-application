<?php

namespace Tests\Unit;

use App\ProductModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DatabaseTransactionTest extends TestCase
{
    use DatabaseTransactions;
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
