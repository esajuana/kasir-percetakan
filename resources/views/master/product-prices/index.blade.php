@extends('layouts.admin')

@section('title', 'Harga Produk')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h3>Harga Produk</h3>

    <a href="{{ route('master.product-prices.create') }}"
       class="btn btn-primary">

        Tambah Harga

    </a>

</div>

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Produk</th>

                    <th>Variant</th>

                    <th>Option</th>

                    <th>Qty</th>

                    <th>Harga</th>

                    <th>Berlaku</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($prices as $price)

                    <tr>

                        <td>
                            {{ $prices->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ $price->product->name }}
                        </td>

                        <td>
                            {{ $price->variant->name ?? '-' }}
                        </td>

                        <td>
                            {{ $price->option->name ?? '-' }}
                        </td>

                        <td>
                            {{ $price->qty_min }}
                            -
                            {{ $price->qty_max }}
                        </td>

                        <td>

                            Rp
                            {{ number_format($price->price,0,',','.') }}

                        </td>

                        <td>

                            {{ $price->effective_from }}

                            @if($price->effective_until)

                                <br>

                                s/d

                                {{ $price->effective_until }}

                            @endif

                        </td>

                        <td>

                            @if($price->status)

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

                            <a href="{{ route('master.product-prices.edit', $price) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form
                                action="{{ route('master.product-prices.destroy', $price) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Tidak ada data harga

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $prices->links() }}

    </div>

</div>

@endsection