<div class="row">

    <div class="col-md-12">

        <div class="mb-3">

            <label class="form-label">
                Nama Kategori
                <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name ?? '') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Masukkan nama kategori">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Status
        </label>

        <select
            name="status"
            class="form-select">

            <option value="1"
                {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="0"
                {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
                Nonaktif
            </option>

        </select>

    </div>

</div>

<div class="mt-3">

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="{{ route('master.categories.index') }}"
       class="btn btn-secondary">

        Kembali

    </a>

</div>