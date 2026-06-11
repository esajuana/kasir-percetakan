<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreFinishingVariantRequest;
use App\Http\Requests\Master\UpdateFinishingVariantRequest;
use App\Models\Finishing;
use App\Models\FinishingVariant;
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
    public function edit(FinishingVariant $variant)
    {
        $finishings = Finishing::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();

        return view(
            'master.finishing-variants.edit',
            compact(
                'variant',
                'finishings'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinishingVariantRequest $request, FinishingVariant $variant)
    {
        $variant->update(
            $request->validated()
        );

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
    public function destroy(FinishingVariant $variant)
    {
        $variant->delete();

        return back()->with(
            'success',
            'Variant finishing berhasil dihapus'
        );
    }
}
