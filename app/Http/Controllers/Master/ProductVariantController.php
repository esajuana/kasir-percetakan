<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreProductVariantRequest;
use App\Http\Requests\Master\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = ProductVariant::with('product')
            ->latest()
            ->paginate(10);

        return view('master.product-variants.index', compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', true)
            ->orderBy('name')
            ->get();

        return view('master.product-variants.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductVariantRequest $request)
    {
        ProductVariant::create(
        $request->validated()
        );

        return redirect()
            ->route('master.product-variants.index')
            ->with(
                'success',
                'Variant berhasil ditambahkan'
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
    public function edit(ProductVariant $product_variant)
    {
        $products = Product::where('status', true)
        ->orderBy('name')
        ->get();

        return view(
            'master.product-variants.edit',
            [
                'variant' => $product_variant,
                'products' => $products
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductVariantRequest $request, ProductVariant $product_variant)
    {
         $product_variant->update(
            $request->validated()
        );

        return redirect()
            ->route('master.product-variants.index')
            ->with(
                'success',
                'Variant berhasil diubah'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $product_variant)
    {
        $product_variant->delete();

        return redirect()
            ->route('master.product-variants.index')
            ->with(
                'success',
                'Variant berhasil dihapus'
            );
    }
}
