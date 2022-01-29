<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_show_a_product_info(): void
    {
        $product = Product::factory()->create();

        $response = $this->get("/admin/products/{$product->id}");

        $response->assertSee($product->name);
    }
}
