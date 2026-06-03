<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.partials.navbar')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-2 p-0">
                @include('layouts.partials.sidebar')
            </div>

            <div class="col-md-10">

                <div class="p-4">

                    @include('layouts.partials.flash-message')

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>