<div class="row">

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
                    {{ old('product_id', $variant->product_id ?? '') == $product->id ? 'selected' : '' }}>

                    {{ $product->name }}

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

<button class="btn btn-primary">
    Simpan
</button>

<a href="{{ route('master.product-variants.index') }}"
   class="btn btn-secondary">

    Kembali

</a>