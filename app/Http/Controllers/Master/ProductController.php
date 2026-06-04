<?php

namespace App\Http\Controllers\Master;

use App\Models\Product;
use App\Models\Category;

use App\Http\Requests\Master\StoreProductRequest;
use App\Http\Requests\Master\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
        ->latest()
        ->paginate(10);

        return view('master.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', true)
        ->orderBy('name')
        ->get();

        return view('master.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Product::create(
            $request->validated()
        );

        return redirect()
        ->route('master.products.index')
        ->with('success', 'Produk berhasil ditambahkan');
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
    public function edit(Product $product)
    {
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'master.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,Product $product)
    {
        $product->update(
            $request->validated()
        );

        return redirect()
            ->route('master.products.index')
            ->with('success', 'Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('master.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
