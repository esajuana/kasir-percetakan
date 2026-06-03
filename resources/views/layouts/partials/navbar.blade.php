<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container-fluid">

        <span class="navbar-brand">
            Kasir Percetakan
        </span>

        <div class="ms-auto">

            <span class="text-white me-3">
                {{ auth()->user()->name }}
            </span>

            <form action="{{ route('logout') }}"
                  method="POST"
                  class="d-inline">

                @csrf

                <button class="btn btn-light btn-sm">
                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>