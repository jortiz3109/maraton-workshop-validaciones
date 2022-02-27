<?php

namespace App\Http\Controllers;

use App\Events\ProductVisited;
use App\Models\Product;
use App\Models\ProductVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Product::select(['id', 'name', 'price', 'quantity', 'description'])->with('images')->paginate();
        return view('products.index', compact('products'));
    }

    public function show(Product $product, Request $request): View
    {

        ProductVisited::dispatch($product, $request->ip(), $request->userAgent());

        return view('products.show', compact('product'));
    }
}
