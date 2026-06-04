@extends('layouts.admin')

@section('title', 'Data Variant Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3 class="mb-0">Data Variant Produk</h3>

    <a href="{{ route('master.product-variants.create') }}"
       class="btn btn-primary">

        Tambah Variant

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped align-middle">

                <thead>

                    <tr>

                        <th width="5%">No</th>

                        <th>Produk</th>

                        <th>Variant</th>

                        <th width="10%">Status</th>

                        <th width="15%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($variants as $variant)

                        <tr>

                            <td>
                                {{ $variants->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $variant->product->name }}
                            </td>

                            <td>
                                {{ $variant->name }}
                            </td>

                            <td>

                                @if($variant->status)

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

                                <a href="{{ route('master.product-variants.edit', $variant) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('master.product-variants.destroy', $variant) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus variant ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                Tidak ada data variant

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $variants->links() }}

        </div>

    </div>

</div>

@endsection