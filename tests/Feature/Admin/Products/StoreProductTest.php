<?php

namespace Tests\Feature\Admin\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_new_product(): void
    {
        $data = $this->productData();

        $response = $this->post('/admin/products', $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', $data);
    }

    /**
     * @param array $data
     * @param string $field
     * @return void
     * @dataProvider invalidDataProvider
     */
    public function test_it_validates_store_product_request(array $data, string $field): void
    {
        $response = $this->post('/admin/products', $data);

        $response->assertSessionHasErrors($field);
    }

    public function invalidDataProvider(): array
    {
        return [
            'validate rule code required' => [
                'data' => array_replace(
                    $this->productData(),
                    ['code' => null]
                ),
                'field' => 'code'
            ],
            'validate rule code alpha_num' => [
                'data' => array_replace(
                    $this->productData(),
                    ['code' => 'abc efd']
                ),
                'field' => 'code'
            ],
            'validate rule code size:10' => [
                'data' => array_replace(
                    $this->productData(),
                    ['code' => 'ABC']
                ),
                'field' => 'code'
            ],
            'validate rule name required' => [
                'data' => array_replace(
                    $this->productData(),
                    ['name' => null]
                ),
                'field' => 'name'
            ],
            'validate rule name min:5' => [
                'data' => array_replace(
                    $this->productData(),
                    ['name' => 'abc']
                ),
                'field' => 'name'
            ],
            'validate rule name max:100' => [
                'data' => array_replace(
                    $this->productData(),
                    ['name' => Str::random(101)]
                ),
                'field' => 'name'
            ],
            'validate rule price required' => [
                'data' => array_replace(
                    $this->productData(),
                    ['price' => null]
                ),
                'field' => 'price'
            ],
            'validate rule price integer' => [
                'data' => array_replace(
                    $this->productData(),
                    ['price' => 'abcs']
                ),
                'field' => 'price'
            ],
            'validate rule price min:1' => [
                'data' => array_replace(
                    $this->productData(),
                    ['price' => 0]
                ),
                'field' => 'price'
            ],
            'validate rule quantity required' => [
                'data' => array_replace(
                    $this->productData(),
                    ['quantity' => null]
                ),
                'field' => 'quantity'
            ],
            'validate rule quantity min:0' => [
                'data' => array_replace(
                    $this->productData(),
                    ['price' => -1]
                ),
                'field' => 'price'
            ],
            'validate rule quantity integer' => [
                'data' => array_replace(
                    $this->productData(),
                    ['quantity' => 'abcs']
                ),
                'field' => 'quantity'
            ],
            'validate rule description required' => [
                'data' => array_replace(
                    $this->productData(),
                    ['description' => null]
                ),
                'field' => 'description'
            ],
            'validate rule description min:10' => [
                'data' => array_replace(
                    $this->productData(),
                    ['description' => 'abcdefghi']
                ),
                'field' => 'description'
            ],
            'validate rule description max:250' => [
                'data' => array_replace(
                    $this->productData(),
                    ['description' => Str::random(251)]
                ),
                'field' => 'description'
            ],
        ];
    }

    private function productData(): array
    {
        return [
            'code' => 'PRD1234567',
            'name' => 'Test product',
            'price' => 100,
            'quantity' => 5,
            'description' => 'Amazing test product'
        ];
    }
}
