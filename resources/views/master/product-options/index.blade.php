@extends('layouts.admin')

@section('title', 'Product Option')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3 class="mb-0">Product Option</h3>

    <a href="{{ route('master.product-options.create') }}"
       class="btn btn-primary">

        Tambah Option

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="5%">No</th>

                        <th>Kategori</th>

                        <th>Option</th>

                        <th width="10%">Status</th>

                        <th width="15%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($options as $option)

                        <tr>

                            <td>
                                {{ $options->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $option->category->name }}
                            </td>

                            <td>
                                {{ $option->name }}
                            </td>

                            <td>

                                @if($option->status)

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

                                <a href="{{ route('master.product-options.edit', $option) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('master.product-options.destroy', $option) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus option ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                Tidak ada data option

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $options->links() }}

        </div>

    </div>

</div>

@endsection