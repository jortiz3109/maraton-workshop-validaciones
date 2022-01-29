<?php

namespace App\Actions;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;

class StoreProductImagesAction
{
    public function execute(array $files, Product $product): void
    {
        $productImages = collect();
        foreach ($files as $file) {
            $image = new Image();
            $image->file_name = (string) Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs($product->id, $image->file_name , config('filesystems.images_disk'));

            $productImages->push($image);
        }

        $product->images()->saveMany($productImages);
    }
}
