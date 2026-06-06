
@push('scripts')
<script>

let index =
    document.querySelectorAll(
        '#price-table-body tr:not(#empty-row)'
    ).length;

function formatRupiah(value)
{
    value = value.replace(/\D/g, '');

    return new Intl.NumberFormat(
        'id-ID'
    ).format(value);
}

/*
|--------------------------------------------------------------------------
| Product Options
|--------------------------------------------------------------------------
*/

const productOptions = {

    @foreach($options as $productId => $productOptions)

        "{{ $productId }}": [

            @foreach($productOptions as $option)

                {
                    id: "{{ $option->id }}",
                    name: "{{ $option->name }}"
                },

            @endforeach

        ],

    @endforeach

};

/*
|--------------------------------------------------------------------------
| Generate Dropdown Option
|--------------------------------------------------------------------------
*/

function createOptionDropdown(index)
{
    let productId =
        document.getElementById(
            'product_id'
        ).value;

    let optionsHtml = `
        <option value="">
            Tanpa Option
        </option>
    `;

    if(productOptions[productId])
    {
        productOptions[productId]
        .forEach(
            option =>
            {
                optionsHtml += `
                    <option value="${option.id}">
                        ${option.name}
                    </option>
                `;
            }
        );
    }

    return `
        <select
            name="price_tiers[${index}][product_option_id]"
            class="form-select option-select">

            ${optionsHtml}

        </select>
    `;
}

/*
|--------------------------------------------------------------------------
| Tambah Tier Harga
|--------------------------------------------------------------------------
*/

function addTierRow()
{
    let productId =
        document.getElementById(
            'product_id'
        ).value;

    if(!productId)
    {
        alert(
            'Pilih produk terlebih dahulu'
        );

        return;
    }

    const emptyRow =
        document.getElementById(
            'empty-row'
        );

    if(emptyRow)
    {
        emptyRow.remove();
    }

    let row = `

        <tr>

            <td>

                ${createOptionDropdown(index)}

            </td>

            <td>

                <input
                    type="number"
                    min="1"
                    value="1"
                    class="form-control"
                    name="price_tiers[${index}][qty_min]">

            </td>

            <td>

                <input
                    type="number"
                    min="1"
                    value="999999"
                    class="form-control"
                    name="price_tiers[${index}][qty_max]">

            </td>

            <td>

                <input
                    type="text"
                    placeholder="Harga"
                    class="form-control price-input"
                    name="price_tiers[${index}][price]">

            </td>

            <td class="text-center">

                <button
                    type="button"
                    class="btn btn-danger btn-sm remove-row">

                    Hapus

                </button>

            </td>

        </tr>

    `;

    document
        .getElementById(
            'price-table-body'
        )
        .insertAdjacentHTML(
            'beforeend',
            row
        );

    index++;
}

/*
|--------------------------------------------------------------------------
| Tombol Tambah Tier
|--------------------------------------------------------------------------
*/

document
.getElementById('add-tier')
.addEventListener(
    'click',
    addTierRow
);

/*
|--------------------------------------------------------------------------
| Hapus Tier
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'click',
    function(e)
    {
        if(
            e.target.classList.contains(
                'remove-row'
            )
        )
        {
            e.target
                .closest('tr')
                .remove();

            let rows =
                document.querySelectorAll(
                    '#price-table-body tr'
                );

            if(rows.length === 0)
            {
                document
                .getElementById(
                    'price-table-body'
                )
                .innerHTML = `
                    <tr id="empty-row">

                        <td
                            colspan="5"
                            class="text-center text-muted">

                            Belum ada tier harga

                        </td>

                    </tr>
                `;
            }
        }
    }
);

/*
|--------------------------------------------------------------------------
| Ganti Produk
|--------------------------------------------------------------------------
*/

document
.getElementById('product_id')
.addEventListener(
    'change',
    function()
    {
        let rows =
            document.querySelectorAll(
                '#price-table-body tr'
            );

        if(
            rows.length > 0 &&
            !document.getElementById(
                'empty-row'
            )
        )
        {
            let confirmed =
                confirm(
                    'Mengganti produk akan menghapus semua tier harga. Lanjutkan?'
                );

            if(!confirmed)
            {
                return;
            }
        }

        document
        .getElementById(
            'price-table-body'
        )
        .innerHTML = `
            <tr id="empty-row">

                <td
                    colspan="5"
                    class="text-center text-muted">

                    Belum ada tier harga

                </td>

            </tr>
        `;

        index = 0;
    }
);

/*
|--------------------------------------------------------------------------
| Modal Option
|--------------------------------------------------------------------------
*/

document
.getElementById(
    'open-option-modal'
)
.addEventListener(
    'click',
    function()
    {
        let productSelect =
            document.getElementById(
                'product_id'
            );

        if(!productSelect.value)
        {
            alert(
                'Pilih produk terlebih dahulu'
            );

            return;
        }

        document
        .getElementById(
            'selected-product'
        )
        .value =
            productSelect.options[
                productSelect.selectedIndex
            ].text;

        new bootstrap.Modal(
            document.getElementById(
                'optionModal'
            )
        ).show();
    }
);

/*
|--------------------------------------------------------------------------
| Simpan Option AJAX
|--------------------------------------------------------------------------
*/

document
.getElementById(
    'save-option'
)
.addEventListener(
    'click',
    function()
    {
        let productId =
            document.getElementById(
                'product_id'
            ).value;

        let optionName =
            document.getElementById(
                'option-name'
            ).value.trim();

        if(optionName === '')
        {
            alert(
                'Nama option wajib diisi'
            );

            return;
        }

        fetch(
            "{{ route('master.product-options.ajax-store') }}",
            {
                method: 'POST',

                headers: {

                    'Content-Type':
                        'application/json',

                    'X-CSRF-TOKEN':
                        document
                        .querySelector(
                            'meta[name="csrf-token"]'
                        )
                        .content
                },

                body: JSON.stringify({

                    product_id:
                        productId,

                    name:
                        optionName

                })
            }
        )
        .then(
            response =>
                response.json()
        )
        .then(
            data =>
            {
                if(data.success)
                {
                    if(!productOptions[productId])
                    {
                        productOptions[productId] = [];
                    }

                    productOptions[productId].push({

                        id: data.option.id,

                        name: data.option.name

                    });

                    document
                    .querySelectorAll(
                        '.option-select'
                    )
                    .forEach(
                        select =>
                        {
                            let option =
                                new Option(
                                    data.option.name,
                                    data.option.id
                                );

                            select.add(option);
                        }
                    );

                    bootstrap.Modal
                    .getInstance(
                        document.getElementById(
                            'optionModal'
                        )
                    )
                    .hide();

                    document
                    .getElementById(
                        'option-name'
                    )
                    .value = '';

                    alert(
                        'Option berhasil ditambahkan'
                    );
                }
            })
        .catch(
            error =>
            {
                console.error(error);

                alert(
                    'Gagal menambahkan option'
                );
            }
        );
    }
);

document.addEventListener(
    'input',
    function(e)
    {
        if(
            e.target.classList.contains(
                'price-input'
            )
        )
        {
            e.target.value =
                formatRupiah(
                    e.target.value
                );
        }
    }
);

</script>

@endpush