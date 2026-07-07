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
        ->groupBy('category_id');

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

                /*
                |--------------------------------------------------------------------------
                | Harga Normal
                |--------------------------------------------------------------------------
                */

                ProductPrice::create([

                    'product_id' =>
                        $request->product_id,

                    'product_variant_id' =>
                        $variant->id,

                    'product_option_id' =>
                        $tier['product_option_id']
                        ?? null,

                    'price_type' =>
                        'normal',

                    'qty_min' =>
                        $tier['qty_min'],

                    'qty_max' =>
                        $tier['qty_max'],

                    'price' =>
                        str_replace(
                            '.',
                            '',
                            $tier['normal_price']
                        ),

                    'effective_from' =>
                        now()->toDateString(),

                    'effective_until' =>
                        null,

                    'status' =>
                        true,

                ]);

                /*
                |--------------------------------------------------------------------------
                | Harga Sponsor
                |--------------------------------------------------------------------------
                */

                if (
                    !empty(
                        $tier['sponsor_price']
                    )
                ) {

                    ProductPrice::create([

                        'product_id' =>
                            $request->product_id,

                        'product_variant_id' =>
                            $variant->id,

                        'product_option_id' =>
                            $tier['product_option_id']
                            ?? null,

                        'price_type' =>
                            'sponsor',

                        'qty_min' =>
                            $tier['qty_min'],

                        'qty_max' =>
                            $tier['qty_max'],

                        'price' =>
                            str_replace(
                                '.',
                                '',
                                $tier['sponsor_price']
                            ),

                        'effective_from' =>
                            now()->toDateString(),

                        'effective_until' =>
                            null,

                        'status' =>
                            true,

                    ]);
                }
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
        $productVariant->load([
            'product.category',
            'prices'
        ]);

        $products = Product::where(
            'status',
            true
        )->orderBy('name')->get();

        $options = ProductOption::where(
            'status',
            true
        )
        ->get()
        ->groupBy('category_id');

        $priceTiers = $productVariant
            ->prices
            ->groupBy(function ($price) {

                return implode('-', [

                    $price->product_option_id,
                    $price->qty_min,
                    $price->qty_max

                ]);

            })
            ->map(function ($group) {

                $normal = $group
                    ->firstWhere(
                        'price_type',
                        'normal'
                    );

                $sponsor = $group
                    ->firstWhere(
                        'price_type',
                        'sponsor'
                    );

                return [

                    'product_option_id' =>
                        $normal?->product_option_id,

                    'qty_min' =>
                        $normal?->qty_min,

                    'qty_max' =>
                        $normal?->qty_max,

                    'normal_price' =>
                        $normal?->price,

                    'sponsor_price' =>
                        $sponsor?->price,

                ];

            })
            ->values();

            return view(
                'master.product-variants.edit',
                [
                    'variant' => $productVariant,
                    'products' => $products,
                    'options' => $options,
                    'priceTiers' => $priceTiers,
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
                /*
                |--------------------------------------------------------------------------
                | Harga Normal
                |--------------------------------------------------------------------------
                */

                ProductPrice::create([

                    'product_id' =>
                        $request->product_id,

                    'product_variant_id' =>
                        $productVariant->id,

                    'product_option_id' =>
                        $tier['product_option_id']
                        ?? null,

                    'price_type' =>
                        'normal',

                    'qty_min' =>
                        $tier['qty_min'],

                    'qty_max' =>
                        $tier['qty_max'],

                    'price' =>
                        str_replace(
                            '.',
                            '',
                            $tier['normal_price']
                        ),

                    'effective_from' =>
                        now(),

                    'status' =>
                        true,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Harga Sponsor
                |--------------------------------------------------------------------------
                */

                if(
                    !empty(
                        $tier['sponsor_price']
                    )
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

                        'price_type' =>
                            'sponsor',

                        'qty_min' =>
                            $tier['qty_min'],

                        'qty_max' =>
                            $tier['qty_max'],

                        'price' =>
                            str_replace(
                                '.',
                                '',
                                $tier['sponsor_price']
                            ),

                        'effective_from' =>
                            now(),

                        'status' =>
                            true,
                    ]);
                }
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