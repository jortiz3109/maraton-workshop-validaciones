<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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
        $this->assertDatabaseHas('products', Arr::except($data, ['images']));
    }

    public function test_it_stores_images_in_filesystem(): void
    {
        Storage::fake(config('filesystems.images_disk'));

        $data = $this->productData();
        $this->post('/admin/products', $data);

        $image = Image::first();

        Storage::disk(config('filesystems.images_disk'))->assertExists("{$image->product_id}/{$image->file_name}");

    }

    private function productData(): array
    {
        return [
            'code' => 'PRD1234567',
            'name' => 'Test product',
            'price' => 100,
            'quantity' => 5,
            'description' => 'Amazing test product',
            'images' => [
                UploadedFile::fake()->image('product.jpg', 500, 250)->size(50),
            ]
        ];
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
            'validate rule images array' => [
                'data' => array_replace($this->productData(), ['images' => '']),
                'field' => 'images'
            ],
            'validate rule images image' => [
                'data' => array_replace
                ($this->productData(),
                    [
                        'images' => [
                            UploadedFile::fake()->create('document.pdf', 100, 'application/pdf')
                        ]
                    ]),
                'field' => 'images.0'
            ],
            'validate rule images max:200' => [
                'data' => array_replace
                ($this->productData(),
                    [
                        'images' => [
                            UploadedFile::fake()->image('product.jpg')->size(201),
                        ]
                    ]),
                'field' => 'images.0'
            ],
            'validate rule images max_width:500' => [
                'data' => array_replace
                ($this->productData(),
                    [
                        'images' => [
                            UploadedFile::fake()->image('product.jpg', 501)->size(150),
                        ]
                    ]),
                'field' => 'images.0'
            ],
            'validate rule images max_height:250' => [
                'data' => array_replace
                ($this->productData(),
                    [
                        'images' => [
                            UploadedFile::fake()->image('product.jpg', 500, 251)->size(150),
                        ]
                    ]),
                'field' => 'images.0'
            ],
            'validate rule images ratio:2/1' => [
                'data' => array_replace
                ($this->productData(),
                    [
                        'images' => [
                            UploadedFile::fake()->image('product.jpg', 500, 240)->size(150),
                        ]
                    ]),
                'field' => 'images.0'
            ]
        ];
    }
}
