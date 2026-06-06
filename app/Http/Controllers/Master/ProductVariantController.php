<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreProductVariantRequest;
use App\Http\Requests\Master\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductVariant;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\DB;
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
        $products = Product::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();

        $options = ProductOption::where(
            'status',
            true
        )
        ->get()
        ->groupBy('product_id');

        return view(
            'master.product-variants.create',
            compact(
                'products',
                'options'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductVariantRequest $request)
    {
        DB::transaction(function () use ($request) {

            $variant = ProductVariant::create([

                'product_id' => $request->product_id,

                'name' => $request->name,

                'status' => $request->status,

            ]);

            foreach (
                $request->input(
                    'price_tiers',
                    []
                ) as $tier
            ) {

                ProductPrice::create([

                    'product_id' =>
                        $request->product_id,

                    'product_variant_id' =>
                        $variant->id,

                    'product_option_id' =>
                        $tier['product_option_id']
                        ?? null,

                    'qty_min' =>
                        $tier['qty_min'],

                    'qty_max' =>
                        $tier['qty_max'],

                    'price' =>
                        $tier['price'],

                    'effective_from' =>
                        now()->toDateString(),

                    'effective_until' =>
                        null,

                    'status' =>
                        true,

                ]);
            }
        });

        return redirect()
            ->route(
                'master.product-variants.index'
            )
            ->with(
                'success',
                'Variant dan harga berhasil ditambahkan'
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
    public function edit(ProductVariant $productVariant)
    {
        $productVariant->load('prices');

        $products = Product::where(
            'status',
            true
        )->orderBy('name')->get();

        $options = ProductOption::where(
            'status',
            true
        )
        ->get()
        ->groupBy('product_id');

        return view(
            'master.product-variants.edit',
            [
                'variant' => $productVariant,
                'products' => $products,
                'options' => $options,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductVariantRequest $request, ProductVariant $productVariant)
    {
        DB::transaction(function () use (
            $request,
            $productVariant
        ) {

            $productVariant->update([

                'product_id' =>
                    $request->product_id,

                'name' =>
                    $request->name,

                'status' =>
                    $request->status,

            ]);

            ProductPrice::where(
                'product_variant_id',
                $productVariant->id
            )->delete();

            foreach(
                $request->price_tiers ?? []
                as $tier
            )
            {
                ProductPrice::create([

                    'product_id' =>
                        $request->product_id,

                    'product_variant_id' =>
                        $productVariant->id,

                    'product_option_id' =>
                        $tier['product_option_id']
                        ?? null,

                    'qty_min' =>
                        $tier['qty_min'],

                    'qty_max' =>
                        $tier['qty_max'],

                    'price' =>
                        $tier['price'],

                    'effective_from' =>
                        now(),

                    'status' =>
                        true,
                ]);
            }
        });

        return redirect()
            ->route(
                'master.product-variants.index'
            )
            ->with(
                'success',
                'Variant berhasil diperbarui'
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
