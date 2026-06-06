<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreProductOptionRequest;
use App\Http\Requests\Master\UpdateProductOptionRequest;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = ProductOption::with('product')
            ->latest()
            ->paginate(10);

        return view(
            'master.product-options.index',
            compact('options')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'master.product-options.create',
            compact('products')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductOptionRequest $request)
    {
        ProductOption::create(
            $request->validated()
        );

        return redirect()
            ->route('master.product-options.index')
            ->with(
                'success',
                'Product Option berhasil ditambahkan'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductOption $product_option)
    {
        $products = Product::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'master.product-options.edit',
            [
                'option' => $product_option,
                'products' => $products
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductOptionRequest $request, ProductOption $product_option)
    {
        $product_option->update(
            $request->validated()
        );

        return redirect()
            ->route('master.product-options.index')
            ->with(
                'success',
                'Product Option berhasil diubah'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductOption $product_option)
    {
        $product_option->delete();

        return redirect()
            ->route('master.product-options.index')
            ->with(
                'success',
                'Product Option berhasil dihapus'
            );
    }

    public function ajaxStore(Request $request)
    {
        $request->validate([

            'product_id' => [
                'required',
                'exists:products,id'
            ],

            'name' => [
                'required',
                'max:100'
            ]
        ]);

        $option = ProductOption::create([

            'product_id' => $request->product_id,

            'name' => $request->name,

            'status' => true

        ]);

        return response()->json([

            'success' => true,

            'option' => [

                'id' => $option->id,

                'name' => $option->name
            ]
        ]);
    }
}
