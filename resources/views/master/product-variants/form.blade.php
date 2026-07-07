<div class="row">

    {{-- Produk --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">

            Produk

        </label>

        <select
            name="product_id"
            id="product_id"
            class="form-select @error('product_id') is-invalid @enderror">

            <option value="">
                Pilih Produk
            </option>

            @foreach($products as $product)

                <option
                    value="{{ $product->id }}"
                    {{ old('product_id', $variant->product_id ?? '') == $product->id ? 'selected' : '' }}>

                    {{ $product->name }}

                </option>

            @endforeach

        </select>

        @error('product_id')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    {{-- Nama Variant --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">

            Nama Variant

        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $variant->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror">

        @error('name')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

</div>

{{-- Status --}}
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

    <div>

        <button
            type="button"
            id="open-option-modal"
            class="btn btn-outline-primary btn-sm">

            + Option Baru

        </button>

        <button
            type="button"
            id="add-tier"
            class="btn btn-success btn-sm">

            + Tambah Tier Harga

        </button>

    </div>

</div>

<div class="table-responsive">

    <table
        class="table table-bordered align-middle"
        id="price-table">

        <thead class="table-light">

            <tr>

                <th width="35%">
                    Option
                </th>

                <th width="15%">
                    Qty Min
                </th>

                <th width="15%">
                    Qty Max
                </th>

                <th width="15%">
                    Harga Normal
                </th>

                <th width="15%">
                    Harga Sponsor
                </th>

                <th width="10%">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody id="price-table-body">

            {{-- Prioritas pertama: data dari old() --}}
            @if(old('price_tiers'))

                @foreach(old('price_tiers') as $i => $tier)

                    <tr>

                        <td>

                            <select
                                name="price_tiers[{{ $i }}][product_option_id]"
                                class="form-select option-select">

                                <option value="">
                                    Tanpa Option
                                </option>

                                @php
                                    $selectedProduct = old(
                                        'product_id',
                                        $variant->product_id ?? null
                                    );

                                    $selectedCategory = $products
                                        ->firstWhere('id', $selectedProduct)
                                        ?->category_id;
                                @endphp

                                @foreach(
                                    $options[$selectedCategory] ?? [] as $option
                                )

                                    <option
                                        value="{{ $option->id }}"
                                        {{
                                            $tier['product_option_id']
                                            == $option->id
                                            ? 'selected'
                                            : ''
                                        }}>

                                        {{ $option->name }}

                                    </option>

                                @endforeach

                            </select>

                        </td>

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

            {{-- Prioritas kedua: data dari database saat edit --}}
            @elseif(
                isset($priceTiers)
                && $priceTiers->count()
            )

                @foreach(
                    $priceTiers as $i => $tier
                )

                    <tr>
                        <td>

                            <select
                                name="price_tiers[{{ $i }}][product_option_id]"
                                class="form-select option-select">

                                <option value="">
                                    Tanpa Option
                                </option>

                                @php
                                    $selectedProduct = old(
                                        'product_id',
                                        $variant->product_id ?? null
                                    );

                                    $selectedCategory = $products
                                        ->firstWhere('id', $selectedProduct)
                                        ?->category_id;
                                @endphp

                                @foreach(
                                    $options[$selectedCategory] ?? [] as $option
                                )

                                    <option
                                        value="{{ $option->id }}"
                                        {{
                                            $tier['product_option_id']
                                            == $option->id
                                            ? 'selected'
                                            : ''
                                        }}>

                                        {{ $option->name }}

                                    </option>

                                @endforeach

                            </select>

                        </td>

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

            {{-- Create baru --}}
            @else

                <tr id="empty-row">

                    <td
                        colspan="6"
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
    href="{{ route('master.product-variants.index') }}"
    class="btn btn-secondary">

    Kembali

</a>

{{-- Modal Option --}}
<div
    class="modal fade"
    id="optionModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Tambah Option

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label">

                        Kategori

                    </label>

                    <input
                        type="text"
                        id="selected-category"
                        class="form-control"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Nama Option

                    </label>

                    <input
                        type="text"
                        id="option-name"
                        class="form-control">

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Batal

                </button>

                <button
                    type="button"
                    id="save-option"
                    class="btn btn-primary">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>