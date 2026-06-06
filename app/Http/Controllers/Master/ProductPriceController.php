<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreProductPriceRequest;
use App\Http\Requests\Master\UpdateProductPriceRequest;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductPrice;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = ProductPrice::with([
            'product',
            'variant'
        ])
        ->latest()
        ->paginate(10);

        return view('master.product-prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where(
        'status',
         true)
            ->orderBy('name')
            ->get();

        $variants = ProductVariant::where(
        'status',
         true)
            ->orderBy('name')
            ->get();

        $options = ProductOption::where(
            'status',
            true
        )->orderBy('name')->get();

        return view(
            'master.product-prices.create',
            compact(
                'products',
                'variants',
                'options'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductPriceRequest $request)
    {
        ProductPrice::create(
            $request->validated()
        );

        return redirect()
            ->route(
                'master.product-prices.index')
            ->with('success', 'Harga berhasil ditambahkan');
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
    public function edit(ProductPrice $product_price)
    {
        $products = Product::where(
            'status',true)
            ->orderBy('name')
            ->get();

        $variants = ProductVariant::where(
            'status',true)
            ->orderBy('name')
            ->get();

        $options = ProductOption::where(
            'status',
            true
        )->orderBy('name')->get();

        return view(
            'master.product-prices.edit',
            [
                'price' => $product_price,
                'products' => $products,
                'variants' => $variants,
                'options' => $options
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductPriceRequest $request, ProductPrice $product_price)
    {
        $product_price->update(
            $request->validated()
        );

        return redirect()
            ->route(
                'master.product-prices.index'
            )
            ->with(
                'success',
                'Harga berhasil diubah'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPrice $product_price)
    {
        $product_price->delete();

        return redirect()
            ->route(
                'master.product-prices.index'
            )
            ->with(
                'success',
                'Harga berhasil dihapus'
            );
    }
}
