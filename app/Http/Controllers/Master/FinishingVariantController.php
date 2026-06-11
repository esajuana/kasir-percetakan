<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreFinishingVariantRequest;
use App\Http\Requests\Master\UpdateFinishingVariantRequest;
use App\Models\Finishing;
use App\Models\FinishingPrice;
use App\Models\FinishingVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FinishingVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = FinishingVariant::with(
        'finishing'
        )
        ->latest()
        ->paginate(10);

        return view(
            'master.finishing-variants.index',
            compact('variants')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $finishings = Finishing::where(
        'status',
        true
        )
        ->orderBy('name')
        ->get();

        return view(
            'master.finishing-variants.create',
            compact('finishings')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinishingVariantRequest $request)
    {
        DB::transaction(function () use ($request) {

            $variant = FinishingVariant::create([

                'finishing_id' =>
                    $request->finishing_id,

                'name' =>
                    $request->name,

                'status' =>
                    $request->status,

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

                FinishingPrice::create([

                    'finishing_id' =>
                        $request->finishing_id,

                    'finishing_variant_id' =>
                        $variant->id,

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

                    FinishingPrice::create([

                        'finishing_id' =>
                            $request->finishing_id,

                        'finishing_variant_id' =>
                            $variant->id,

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
                'master.finishing-variants.index'
            )
            ->with(
                'success',
                'Variant finishing dan harga berhasil ditambahkan'
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
    public function edit(FinishingVariant $finishingVariant)
    {
        $finishingVariant->load('prices');

        $finishings = Finishing::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();

        $priceTiers = $finishingVariant
            ->prices
            ->groupBy(function ($price) {

                return implode('-', [

                    $price->qty_min,
                    $price->qty_max,

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
            'master.finishing-variants.edit',
            [
                'variant' => $finishingVariant,
                'finishings' => $finishings,
                'priceTiers' => $priceTiers,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinishingVariantRequest $request,FinishingVariant $finishingVariant)
    {
        DB::transaction(function () use (
            $request,
            $finishingVariant
        ) {

            $finishingVariant->update([

                'finishing_id' =>

                    $request->finishing_id,

                'name' =>

                    $request->name,

                'status' =>

                    $request->status,

            ]);

            FinishingPrice::where(

                'finishing_variant_id',
                $finishingVariant->id

            )->delete();

            foreach (
                $request->price_tiers ?? []
                as $tier
            ) {

                /*
                |--------------------------------------------------------------------------
                | Harga Normal
                |--------------------------------------------------------------------------
                */

                FinishingPrice::create([

                    'finishing_id' =>

                        $request->finishing_id,

                    'finishing_variant_id' =>

                        $finishingVariant->id,

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

                if (
                    !empty(
                        $tier['sponsor_price']
                    )
                ) {

                    FinishingPrice::create([

                        'finishing_id' =>

                            $request->finishing_id,

                        'finishing_variant_id' =>

                            $finishingVariant->id,

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
                'master.finishing-variants.index'
            )
            ->with(
                'success',
                'Variant finishing berhasil diperbarui'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinishingVariant $finishingVariant)
    {
        $finishingVariant->delete();

        return back()->with(
            'success',
            'Variant finishing berhasil dihapus'
        );
    }
}
