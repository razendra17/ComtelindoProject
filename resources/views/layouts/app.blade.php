<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body class="min-h-screen flex flex-col">

    <div class="bg-[#f5f5f5] flex-1 py-0.5">
        @include('layouts.header.index')

        <div class="relative max-w-[96%] mx-auto bg-[#ffffff] px-6 py-6 overflow-hidden flex flex-col shadow-xl flex-1">
            @include('layouts.sidebar.sidebar')

            <main class="flex-grow">
                @yield('content')

                <div class="flex my-auto mx-auto">
                    @yield('modal')
                </div>

                @yield('script')
            </main>
        </div>
    </div>

    @include('layouts.footer.index')


    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- SWAL -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    
</body>

</html>
