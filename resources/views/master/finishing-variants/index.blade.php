@extends('layouts.admin')

@section('title', 'Finishing Variant')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <span>
            Finishing Variant
        </span>

        <a
            href="{{ route('master.finishing-variants.create') }}"
            class="btn btn-primary btn-sm">

            Tambah Variant

        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th width="5%">
                            No
                        </th>

                        <th>
                            Finishing
                        </th>

                        <th>
                            Variant
                        </th>

                        <th width="10%">
                            Status
                        </th>

                        <th width="15%">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($variants as $variant)

                        <tr>

                            <td>

                                {{
                                    $loop->iteration
                                    +
                                    (
                                        $variants->currentPage() - 1
                                    )
                                    *
                                    $variants->perPage()
                                }}

                            </td>

                            <td>

                                {{ $variant->finishing->name }}

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

                                <a
                                    href="{{ route(
                                        'master.finishing-variants.edit',
                                        $variant
                                    ) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route(
                                        'master.finishing-variants.destroy',
                                        $variant
                                    ) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center">

                                Belum ada data

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