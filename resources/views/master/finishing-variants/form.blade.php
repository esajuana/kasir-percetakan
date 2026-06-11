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

            <tr id="empty-row">

                <td
                    colspan="5"
                    class="text-center text-muted">

                    Belum ada tier harga

                </td>

            </tr>

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