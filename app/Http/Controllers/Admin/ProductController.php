<?php

namespace App\Http\Controllers\Admin;

use App\Actions\StoreProductImagesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::select(['id', 'name', 'price', 'quantity', 'disabled_at'])->withCount('images')->paginate();
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request, StoreProductImagesAction $imagesAction): RedirectResponse
    {
        /**
         * OPCIÓN 1 - USANDO EL MÉTODO VALIDATE DEL OBJETO Request
         * $request->validate([
         * 'code' => ['required', 'size:10', 'alpha_num'],
         * 'name' => ['required', 'min:5', 'max:100'],
         * 'price' => ['required', 'integer', 'min:1'],
         * 'quantity' => ['required', 'integer', 'min:0'],
         * 'description' => ['required', 'min:10', 'max:250'],
         * ]);
         */

        /**
         * OPCIÓN 2 - USANDO LA FACHADA VALIDATOR
         * $validator = Validator::make($request->all(), [
         *     'code' => ['required', 'size:10', 'alpha_num'],
         *     'name' => ['required', 'min:5', 'max:100'],
         *     'price' => ['required', 'integer', 'min:1'],
         *     'quantity' => ['required', 'integer', 'min:0'],
         *     'description' => ['required', 'min:10', 'max:250'],
         * ], [
         *     'required' => 'Venga!! el :attribute es necesario para esta operación',
         *     'min' => 'No seas así!!!! dame un valor mínimo para este campo :attribute de :min'
         * ]);
         * if ($validator->fails()) {
         *     return redirect()->back()->withErrors($validator->errors())->withInput();
         * }
         *
         */

        $product = new Product();
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');

        $product->save();

        $imagesAction->execute($request->images, $product);

        return redirect(route('admin.products.show', $product));
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
