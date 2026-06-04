@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3 class="mb-0">Data Produk</h3>

    <a href="{{ route('master.products.create') }}"
       class="btn btn-primary">

        Tambah Produk

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped align-middle">

                <thead>

                    <tr>

                        <th width="5%">No</th>

                        <th>Kode</th>

                        <th>Nama Produk</th>

                        <th>Kategori</th>

                        <th>Tipe Hitung</th>

                        <th>Min. Harga</th>

                        <th>Fitur</th>

                        <th>Status</th>

                        <th width="15%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <td>
                                {{ $products->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $product->code }}
                            </td>

                            <td>

                                <strong>
                                    {{ $product->name }}
                                </strong>

                                @if($product->description)

                                    <br>

                                    <small class="text-muted">
                                        {{ Str::limit($product->description, 50) }}
                                    </small>

                                @endif

                            </td>

                            <td>
                                {{ $product->category->name ?? '-' }}
                            </td>

                            <td>

                                @switch($product->calculation_type)

                                    @case('area')
                                        <span class="badge bg-primary">Area</span>
                                        @break

                                    @case('length')
                                        <span class="badge bg-info">Length</span>
                                        @break

                                    @case('unit')
                                        <span class="badge bg-success">Unit</span>
                                        @break

                                    @case('size_fixed')
                                        <span class="badge bg-warning">Size Fixed</span>
                                        @break

                                    @case('package')
                                        <span class="badge bg-dark">Package</span>
                                        @break

                                    @default
                                        <span class="badge bg-secondary">Manual</span>

                                @endswitch

                            </td>

                            <td>

                                Rp
                                {{ number_format($product->minimum_price,0,',','.') }}

                            </td>

                            <td>

                                @if($product->allow_finishing)
                                    <span class="badge bg-success">
                                        Finishing
                                    </span>
                                @endif

                                @if($product->manage_stock)
                                    <span class="badge bg-info">
                                        Stock
                                    </span>
                                @endif

                                @if($product->is_package)
                                    <span class="badge bg-warning text-dark">
                                        Package
                                    </span>
                                @endif

                            </td>

                            <td>

                                @if($product->status)

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('master.products.edit', $product) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('master.products.destroy', $product) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center">

                                Tidak ada data produk

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $products->links() }}

        </div>

    </div>

</div>

@endsection