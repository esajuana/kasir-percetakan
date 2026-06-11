<script>

let index = 0;

function addTierRow()
{
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
                    class="form-control price-input"
                    placeholder="Harga Normal"
                    name="price_tiers[${index}][normal_price]">

            </td>

            <td>

                <input
                    type="text"
                    class="form-control price-input"
                    placeholder="Harga Sponsor"
                    name="price_tiers[${index}][sponsor_price]">

            </td>

            <td>

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

document
.getElementById('add-tier')
.addEventListener(
    'click',
    addTierRow
);

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
        }
    }
);

</script>