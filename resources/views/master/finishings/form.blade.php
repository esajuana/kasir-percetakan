<div class="row">

    {{-- Kategori --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Kategori
        </label>

        <select
            name="category_id"
            class="form-select @error('category_id') is-invalid @enderror">

            <option value="">
                Pilih Kategori
            </option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $finishing->category_id ?? '') == $category->id ? 'selected' : '' }}>

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

    {{-- Nama Finishing --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Nama Finishing
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $finishing->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>

<div class="row">

    {{-- Pricing Type --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Tipe Perhitungan
        </label>

        <select
            name="pricing_type"
            class="form-select @error('pricing_type') is-invalid @enderror">

            <option value="">
                Pilih Tipe
            </option>

            <option
                value="unit"
                {{ old('pricing_type', $finishing->pricing_type ?? '') == 'unit' ? 'selected' : '' }}>

                Qty
            </option>

            <option
                value="area"
                {{ old('pricing_type', $finishing->pricing_type ?? '') == 'area' ? 'selected' : '' }}>

                Area
            </option>

            <option
                value="length"
                {{ old('pricing_type', $finishing->pricing_type ?? '') == 'length' ? 'selected' : '' }}>

                Length
            </option>

            <option
                value="perimeter"
                {{ old('pricing_type', $finishing->pricing_type ?? '') == 'perimeter' ? 'selected' : '' }}>

                Perimeter
            </option>

            <option
                value="manual"
                {{ old('pricing_type', $finishing->pricing_type ?? '') == 'manual' ? 'selected' : '' }}>

                Manual
            </option>

        </select>

        @error('pricing_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Status --}}
    <div class="col-md-6 mb-3">

        <label class="form-label d-block">
            Status
        </label>

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
                {{ old('status', $finishing->status ?? true) ? 'checked' : '' }}>

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

<a
    href="{{ route('master.finishings.index') }}"
    class="btn btn-secondary">

    Kembali

</a>