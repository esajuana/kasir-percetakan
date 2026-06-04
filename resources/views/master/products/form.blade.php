<div class="row">

    {{-- Kategori --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Kategori
            <span class="text-danger">*</span>
        </label>

        <select
            name="category_id"
            class="form-select @error('category_id') is-invalid @enderror">

            <option value="">
                -- Pilih Kategori --
            </option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Kode --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Kode Produk
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="code"
            value="{{ old('code', $product->code ?? '') }}"
            class="form-control @error('code') is-invalid @enderror">

        @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Nama Produk --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Nama Produk
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Deskripsi --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Deskripsi
        </label>

        <textarea
            name="description"
            rows="3"
            class="form-control">{{ old('description', $product->description ?? '') }}</textarea>

    </div>

    {{-- Tipe Perhitungan --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Tipe Perhitungan
        </label>

        <select
            name="calculation_type"
            class="form-select">

            <option value="area"
                {{ old('calculation_type', $product->calculation_type ?? '') == 'area' ? 'selected' : '' }}>
                Area (m²)
            </option>

            <option value="length"
                {{ old('calculation_type', $product->calculation_type ?? '') == 'length' ? 'selected' : '' }}>
                Length (Meter)
            </option>

            <option value="unit"
                {{ old('calculation_type', $product->calculation_type ?? '') == 'unit' ? 'selected' : '' }}>
                Unit / PCS
            </option>

            <option value="size_fixed"
                {{ old('calculation_type', $product->calculation_type ?? '') == 'size_fixed' ? 'selected' : '' }}>
                Ukuran Tetap
            </option>

            <option value="package"
                {{ old('calculation_type', $product->calculation_type ?? '') == 'package' ? 'selected' : '' }}>
                Paket
            </option>

            <option value="manual"
                {{ old('calculation_type', $product->calculation_type ?? '') == 'manual' ? 'selected' : '' }}>
                Manual
            </option>

        </select>

    </div>

    {{-- Minimum Price --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Harga Minimum
        </label>

        <input
            type="number"
            step="0.01"
            name="minimum_price"
            value="{{ old('minimum_price', $product->minimum_price ?? 0) }}"
            class="form-control">

    </div>

    {{-- Pembulatan --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Pembulatan
        </label>

        <select
            name="rounding_type"
            class="form-select">

            <option value="none">Tidak Ada</option>

            <option value="decimal_1"
                {{ old('rounding_type', $product->rounding_type ?? '') == 'decimal_1' ? 'selected' : '' }}>
                1 Desimal
            </option>

            <option value="decimal_2"
                {{ old('rounding_type', $product->rounding_type ?? '') == 'decimal_2' ? 'selected' : '' }}>
                2 Desimal
            </option>

            <option value="ceil"
                {{ old('rounding_type', $product->rounding_type ?? '') == 'ceil' ? 'selected' : '' }}>
                Pembulatan Atas
            </option>

        </select>

    </div>

</div>

<hr>

<h5>Pengaturan Produk</h5>

<div class="row">

    <div class="col-md-3">

        <div class="form-check">

            <input
                type="hidden"
                name="allow_finishing"
                value="0">

            <input
                type="checkbox"
                name="allow_finishing"
                value="1"
                class="form-check-input"
                {{ old('allow_finishing', $product->allow_finishing ?? true) ? 'checked' : '' }}>

            <label class="form-check-label">
                Allow Finishing
            </label>

        </div>

    </div>

    <div class="col-md-3">

        <div class="form-check">

            <input
                type="hidden"
                name="is_package"
                value="0">

            <input
                type="checkbox"
                name="is_package"
                value="1"
                class="form-check-input"
                {{ old('is_package', $product->is_package ?? false) ? 'checked' : '' }}>

            <label class="form-check-label">
                Produk Paket
            </label>

        </div>

    </div>

    <div class="col-md-3">

        <div class="form-check">

            <input
                type="hidden"
                name="manage_stock"
                value="0">

            <input
                type="checkbox"
                name="manage_stock"
                value="1"
                class="form-check-input"
                {{ old('manage_stock', $product->manage_stock ?? false) ? 'checked' : '' }}>

            <label class="form-check-label">
                Kelola Stok
            </label>

        </div>

    </div>

    <div class="col-md-3">

        <div class="form-check">

            <input
                type="hidden"
                name="status"
                value="0">

            <input
                type="checkbox"
                name="status"
                value="1"
                class="form-check-input"
                {{ old('status', $product->status ?? true) ? 'checked' : '' }}>

            <label class="form-check-label">
                Aktif
            </label>

        </div>

    </div>

</div>

<hr>

<button
    type="submit"
    class="btn btn-primary">

    Simpan

</button>

<a href="{{ route('master.products.index') }}"
   class="btn btn-secondary">

    Kembali

</a>