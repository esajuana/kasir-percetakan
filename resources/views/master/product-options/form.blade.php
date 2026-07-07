<div class="row">

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
                    {{ old('category_id', $option->category_id ?? '') == $category->id ? 'selected' : '' }}>

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

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Nama Option
        </label>

        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $option->name ?? '') }}">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

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
        {{ old('status', $option->status ?? true) ? 'checked' : '' }}>

    <label class="form-check-label">
        Aktif
    </label>

</div>

<button
    type="submit"
    class="btn btn-primary">

    Simpan

</button>

<a href="{{ route('master.product-options.index') }}"
   class="btn btn-secondary">

    Kembali

</a>