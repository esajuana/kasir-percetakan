@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {
        /*
        |--------------------------------------------------------------------------
        | Index Tier
        |--------------------------------------------------------------------------
        */

        let index =
            document.querySelectorAll(
                '#price-table-body tr:not(#empty-row)'
            ).length;

        /*
        |--------------------------------------------------------------------------
        | Format Rupiah
        |--------------------------------------------------------------------------
        */

        function formatRupiah(value)
        {
            value = value.replace(/\D/g, '');

            return new Intl.NumberFormat(
                'id-ID'
            ).format(value);
        }

        /*
        |--------------------------------------------------------------------------
        | Tambah Tier Harga
        |--------------------------------------------------------------------------
        */

        function addTierRow()
        {
            const emptyRow =
                document.getElementById(
                    'empty-row'
                );

            if (emptyRow)
            {
                emptyRow.remove();
            }

            let row = `

                <tr>

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
                            placeholder="Harga Normal"
                            class="form-control price-input"
                            name="price_tiers[${index}][normal_price]">

                    </td>

                    <td>

                        <input
                            type="text"
                            placeholder="Harga Sponsor"
                            class="form-control price-input"
                            name="price_tiers[${index}][sponsor_price]">

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

        const addButton =
            document.getElementById(
                'add-tier'
            );

        if (addButton)
        {
            addButton.addEventListener(
                'click',
                addTierRow
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus Tier
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'click',
            function (e)
            {
                if (
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
                            '#price-table-body tr:not(#empty-row)'
                        );

                    if (rows.length === 0)
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
        | Format Rupiah Otomatis
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'input',
            function (e)
            {
                if (
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
    }
);

</script>

@endpush