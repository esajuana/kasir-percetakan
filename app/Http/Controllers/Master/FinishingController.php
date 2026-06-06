<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreFinishingRequest;
use App\Http\Requests\Master\UpdateFinishingRequest;
use App\Models\Category;
use App\Models\Finishing;
use Illuminate\Http\Request;

class FinishingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finishings = Finishing::with('category')
        ->latest()
        ->paginate(10);

        return view(
            'master.finishings.index',
            compact('finishings')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();

        return view(
            'master.finishings.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinishingRequest $request)
    {
        Finishing::create(
            $request->validated()
        );

        return redirect()
        ->route('master.finishings.index')
        ->with(
            'success',
            'Finishing berhasil ditambahkan'
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
    public function edit(Finishing $finishing)
    {
        $categories = Category::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();

        return view(
            'master.finishings.edit',
            compact('finishing', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinishingRequest $request, Finishing $finishing)
    {
        $finishing->update(
            $request->validated()
        );

        return redirect()
            ->route('master.finishings.index')
            ->with(
                'success',
                'Finishing berhasil diperbaharui'
            );
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finishing $finishing)
    {
        $finishing->delete();

        return back()->with(
            'success',
            'Finishing berhasil dihapus'
        );
    }
}
