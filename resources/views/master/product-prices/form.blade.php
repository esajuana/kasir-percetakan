<div class="col-md-6 mb-3">

    <label class="form-label">
        Option
    </label>

    <select
        name="product_option_id"
        class="form-select">

        <option value="">
            Pilih Option
        </option>

        @foreach($options as $option)

            <option
                value="{{ $option->id }}"
                {{ old('product_option_id', $price->product_option_id ?? '') == $option->id ? 'selected' : '' }}>

                {{ $option->product->name }}
                - {{ $option->name }}

            </option>

        @endforeach

    </select>

</div>