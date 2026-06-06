@extends('layouts.admin')

@section('title', 'Data Finishing')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h3>Data Finishing</h3>

    <a
        href="{{ route('master.finishings.create') }}"
        class="btn btn-primary">

        Tambah Finishing

    </a>

</div>

<div class="card">

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Finishing</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($finishings as $finishing)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $finishing->category->name ?? '-' }}
                        </td>

                        <td>
                            {{ $finishing->name }}
                        </td>

                        <td>
                            {{ $finishing->pricing_type }}
                        </td>

                        <td>

                            @if($finishing->status)

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

                            <a
                                href="{{ route('master.finishings.edit', $finishing) }}"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>

                                <form
                                    action="{{ route('master.finishings.destroy', $finishing) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus finishing ini?')">

                                        Hapus

                                    </button>

                                </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center">

                            Belum ada data

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $finishings->links() }}

    </div>

</div>

@endsection