<div class="bg-dark text-white vh-100">

    <div class="p-3">

        <h5>Kasir Percetakan</h5>

        <hr>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link text-white">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('master.categories.index') }}"
                   class="nav-link text-white">
                    Kategori
                </a>
            </li>

           <li class="nav-item">
                <a href="{{ route('master.products.index') }}"
                class="nav-link text-white">

                    Produk

                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('master.product-variants.index') }}"
                class="nav-link text-white">

                    Variant Produk

                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('master.product-prices.index') }}"
                class="nav-link text-white">

                    Harga Produk

                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('master.product-options.index') }}"
                class="nav-link text-white">

                    Product Option

                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('master.finishings.index') }}"
                class="nav-link text-white">

                    Finishing

                </a>
            </li>

        </ul>

    </div>

</div>