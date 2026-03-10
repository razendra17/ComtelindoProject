@extends('layouts.app')
@section('content')
    <!-- Banner -->
    <div class="max-w-5xl w-full px-4 py-3 mx-auto flex justify-center">
        <img src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" alt=""
            class="w-full rounded-3xl object-cover">
    </div>

    <div class="max-w-5xl w-full px-4 mx-auto mt-6 relative">

        <button id="city-toggle"
            class="w-full border border-amber-500 rounded-xl shadow-lg hover:shadow-xl transition duration-300">

            <div class="px-4 py-3 text-left">
                <p class="font-medium text-black">
                    Pilih Kota anda
                </p>
                <p id="current-city" class="text-gray-600 text-sm mt-1"></p>
            </div>

        </button>

        <!-- DROPDOWN -->
        <div id="cityDropdown" class="hidden absolute top-0 right-[-280px] w-64 bg-white rounded-2xl shadow-xl p-4 z-50">

            <p class="font-semibold mb-2">Pilih Kota</p>

            <select id="citySelect"
                class="w-full border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Pilih Kota</option>

                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

            <button id="select-location" class="mt-3 w-full bg-amber-400 hover:bg-amber-500 text-white rounded-xl py-2">
                Pilih lokasi
            </button>

        </div>

    </div>

    <!-- Package List -->
    <div id="packageList" class="max-w-5xl w-full mx-auto mt-8 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>
@endsection
@include('pages.user.modal.paket')

@section('script')
    <script>
        $(document).ready(function() {

            let citySelected = false;

            // ===============================
            // TOGGLE DROPDOWN KOTA
            // ===============================

            $('#city-toggle').on('click', function(e) {
                e.stopPropagation();
                $('#cityDropdown').toggleClass('hidden');
            });

            // klik di luar dropdown → close
            $(document).on('click', function() {
                $('#cityDropdown').addClass('hidden');
            });

            // klik di dalam dropdown jangan close
            $('#cityDropdown').on('click', function(e) {
                e.stopPropagation();
            });


            // ===============================
            // PILIH KOTA
            // ===============================

            $('#select-location').on('click', function() {

                let cityId = $('#citySelect').val();

                if (!cityId) {
                    toastr.error('Pilih kota dulu!', 'Lokasi Belum Dipilih');
                    return;
                }

                $.ajax({
                    url: '/user/by-city/' + cityId,
                    type: 'GET',
                    success: function(response) {

                        citySelected = true;

                        toastr.success('Paket berhasil di load!');

                        $('#packageList').html(response);

                        $('#cityDropdown').addClass('hidden');
                    }
                });

                let cityName = $('#citySelect option:selected').text();
                $('#current-city').text(cityName);

            });


            // ===============================
            // MODAL DETAIL PAKET
            // ===============================

            $(document).on('click', '.package-card', function() {

                const pkg = JSON.parse($(this).attr('data-package'));

                $('#modalName').text(pkg.name);
                $('#modalSpeed').text(pkg.speed);
                $('#modalDevice').text(pkg.device);
                $('#modalPrice').text(
                    new Intl.NumberFormat('id-ID').format(pkg.price)
                );

                const slug = pkg.name.replace(/\s+/g, '-').toLowerCase();

                document.getElementById('choose-package').href =
                    `/user/area/${slug}-${pkg.id}`;

                $('#packageModal').removeClass('hidden');

            });


            // ===============================
            // CLOSE MODAL PAKET
            // ===============================

            $('#close-modal').on('click', function() {
                $('#packageModal').addClass('hidden');
            });

        });
    </script>
@endsection
