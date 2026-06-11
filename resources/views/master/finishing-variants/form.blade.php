<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Finishing

        </label>

        <select
            name="finishing_id"
            class="form-select @error('finishing_id') is-invalid @enderror">

            <option value="">
                Pilih Finishing
            </option>

            @foreach($finishings as $finishing)

                <option
                    value="{{ $finishing->id }}"
                    {{ old('finishing_id', $variant->finishing_id ?? '') == $finishing->id ? 'selected' : '' }}>

                    {{ $finishing->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Nama Variant

        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $variant->name ?? '') }}"
            class="form-control">

    </div>

</div>

<div class="form-check mb-3">

    <input
        type="hidden"
        name="status"
        value="0">

    <input
        type="checkbox"
        name="status"
        value="1"
        class="form-check-input"
        {{ old('status', $variant->status ?? true) ? 'checked' : '' }}>

    <label class="form-check-label">

        Aktif

    </label>

</div>
<hr>

<div class="d-flex justify-content-between align-items-center mb-3">

    <h5 class="mb-0">
        Tier Harga
    </h5>

    <button
        type="button"
        id="add-tier"
        class="btn btn-success btn-sm">

        + Tambah Tier Harga

    </button>

</div>

<div class="table-responsive">

    <table
        class="table table-bordered"
        id="price-table">

        <thead>

            <tr>

                <th width="15%">
                    Qty Min
                </th>

                <th width="15%">
                    Qty Max
                </th>

                <th width="25%">
                    Harga Normal
                </th>

                <th width="25%">
                    Harga Sponsor
                </th>

                <th width="10%">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody id="price-table-body">

            {{-- Prioritas 1: tampilkan data lama jika validation gagal --}}
            @if(old('price_tiers'))

                @foreach(old('price_tiers') as $i => $tier)

                    <tr>

                        <td>

                            <input
                                type="number"
                                class="form-control"
                                name="price_tiers[{{ $i }}][qty_min]"
                                value="{{ $tier['qty_min'] ?? '' }}">

                        </td>

                        <td>

                            <input
                                type="number"
                                class="form-control"
                                name="price_tiers[{{ $i }}][qty_max]"
                                value="{{ $tier['qty_max'] ?? '' }}">

                        </td>

                        <td>

                            <input
                                type="text"
                                class="form-control price-input"
                                name="price_tiers[{{ $i }}][normal_price]"
                                value="{{ $tier['normal_price'] ?? '' }}">

                        </td>

                        <td>

                            <input
                                type="text"
                                class="form-control price-input"
                                name="price_tiers[{{ $i }}][sponsor_price]"
                                value="{{ $tier['sponsor_price'] ?? '' }}">

                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm remove-row">

                                Hapus

                            </button>

                        </td>

                    </tr>

                @endforeach

            {{-- Prioritas 2: tampilkan data dari database saat edit --}}
            @elseif(
                isset($priceTiers)
                && $priceTiers->count()
            )

                @foreach(
                    $priceTiers as $i => $tier
                )

                    <tr>

                        <td>

                            <input
                                type="number"
                                class="form-control"
                                name="price_tiers[{{ $i }}][qty_min]"
                                value="{{ $tier['qty_min'] }}">

                        </td>

                        <td>

                            <input
                                type="number"
                                class="form-control"
                                name="price_tiers[{{ $i }}][qty_max]"
                                value="{{ $tier['qty_max'] }}">

                        </td>

                        <td>

                            <input
                                type="text"
                                class="form-control price-input"
                                name="price_tiers[{{ $i }}][normal_price]"
                                value="{{ number_format($tier['normal_price'], 0, ',', '.') }}">

                        </td>

                        <td>

                            <input
                                type="text"
                                class="form-control price-input"
                                name="price_tiers[{{ $i }}][sponsor_price]"
                                value="{{ $tier['sponsor_price']
                                    ? number_format($tier['sponsor_price'], 0, ',', '.')
                                    : '' }}">

                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm remove-row">

                                Hapus

                            </button>

                        </td>

                    </tr>

                @endforeach

            {{-- Prioritas 3: create baru --}}
            @else

                <tr id="empty-row">

                    <td
                        colspan="5"
                        class="text-center text-muted">

                        Belum ada tier harga

                    </td>

                </tr>

            @endif

        </tbody>

    </table>

</div>

<hr>

<button
    type="submit"
    class="btn btn-primary">

    Simpan

</button>

<a
    href="{{ route('master.finishing-variants.index') }}"
    class="btn btn-secondary">

    Kembali

</a>