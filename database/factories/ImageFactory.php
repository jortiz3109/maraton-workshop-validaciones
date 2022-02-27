<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Image $image) {
            Storage::disk(config('filesystems.images_disk'))
                ->put(
                    implode( DIRECTORY_SEPARATOR, $image->only(['product_id', 'file_name'])),
                    file_get_contents(storage_path('app/default-product-image.png'))
                );
        });
    }

    public function definition(): array
    {
        return [
            'product_id' => Product::factory()->create(),
            'file_name' => implode('.', [Str::uuid()->toString(), 'png']),
        ];
    }
}
