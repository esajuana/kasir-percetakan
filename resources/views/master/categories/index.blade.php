@extends('layouts.admin')

@section('title', 'Data Kategori')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3 class="mb-0">Data Kategori</h3>

    <a href="{{ route('master.categories.create') }}"
       class="btn btn-primary">
        Tambah Kategori
    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="5%">No</th>

                        <th>Nama Kategori</th>

                        <th width="15%">Status</th>

                        <th width="20%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($categories as $category)

                        <tr>

                            <td>
                                {{ $categories->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $category->name }}
                            </td>

                            <td>

                                @if($category->status)

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

                                <a href="{{ route('master.categories.edit', $category) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('master.categories.destroy', $category) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                Tidak ada data kategori

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $categories->links() }}

        </div>

    </div>

</div>

@endsection