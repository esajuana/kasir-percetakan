<div class="row">

    {{-- Produk --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Produk
        </label>

        <select
            name="product_id"
            class="form-select">

            <option value="">
                Pilih Produk
            </option>

            @foreach($products as $product)

                <option
                    value="{{ $product->id }}"
                    {{ old('product_id', $price->product_id ?? '') == $product->id ? 'selected' : '' }}>

                    {{ $product->name }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- Variant --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Variant
        </label>

        <select
            name="product_variant_id"
            class="form-select">

            <option value="">
                Tanpa Variant
            </option>

            @foreach($variants as $variant)

                <option
                    value="{{ $variant->id }}"
                    {{ old('product_variant_id', $price->product_variant_id ?? '') == $variant->id ? 'selected' : '' }}>

                    {{ $variant->product->name }}
                    -
                    {{ $variant->name }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="row">

    <div class="col-md-3 mb-3">

        <label class="form-label">
            Qty Min
        </label>

        <input
            type="number"
            name="qty_min"
            class="form-control"
            value="{{ old('qty_min', $price->qty_min ?? 1) }}">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">
            Qty Max
        </label>

        <input
            type="number"
            name="qty_max"
            class="form-control"
            value="{{ old('qty_max', $price->qty_max ?? '') }}">

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Harga
        </label>

        <input
            type="number"
            step="0.01"
            name="price"
            class="form-control"
            value="{{ old('price', $price->price ?? '') }}">

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Berlaku Dari
        </label>

        <input
            type="date"
            name="effective_from"
            class="form-control"
            value="{{ old('effective_from', isset($price) ? $price->effective_from : date('Y-m-d')) }}">

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Berlaku Sampai
        </label>

        <input
            type="date"
            name="effective_until"
            class="form-control"
            value="{{ old('effective_until', $price->effective_until ?? '') }}">

    </div>

</div>

<hr>

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
        {{ old('status', $price->status ?? true) ? 'checked' : '' }}>

    <label class="form-check-label">
        Aktif
    </label>

</div>

<button
    type="submit"
    class="btn btn-primary">

    Simpan

</button>

<a href="{{ route('master.product-prices.index') }}"
   class="btn btn-secondary">

    Kembali

</a>