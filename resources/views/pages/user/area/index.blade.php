@extends('layouts.app')
@section('content')
    <form action="{{ route('area.store', $slug) }}" method="POST">
        @csrf
        <!-- HEADER -->
        <div class=" bg-white shadow-sm px-4 md:px-8 py-4">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <!-- Title -->
                <div class="flex items-center gap-3">
                    <span>
                        <a href="{{ url()->previous() }}" class="text-xl cursor-pointer">←</a>
                    </span>

                    <h1 class="font-semibold text-lg">
                        Atur Lokasi Pemasangan
                    </h1>
                </div>

                <!-- STEP PROGRESS -->
                <div class="flex items-center gap-4 text-xs sm:text-sm overflow-x-auto">

                    <div class="flex items-center gap-2 text-green-600 font-medium whitespace-nowrap">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-green-600">
                            1
                        </span>
                        Lokasi
                    </div>

                    <div class="flex items-center gap-2 text-gray-400 whitespace-nowrap">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full border">
                            2
                        </span>
                        Data Diri
                    </div>

                    <div class="flex items-center gap-2 text-gray-400 whitespace-nowrap">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full border">
                            3
                        </span>
                        Kirim
                    </div>

                </div>

            </div>
        </div>


        <!-- CONTENT -->
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 lg:gap-6 p-3">

            <!-- LEFT: MAP -->
            <div class="lg:col-span-8 bg-white lg:rounded-xl lg:shadow-sm overflow-hidden relative h-full lg:h-screen">

                <!-- SEARCH BAR -->
                <div class="absolute top-3 left-3 right-3 z-10">
                    <input id="searchAddress" type="text" placeholder="Cari alamat"
                        class=" w-full md:w-[80%] mx-auto block bg-white rounded-full px-4 py-2.5 text-sm shadow focus:outline-none focus:ring-2 focus:ring-red-400">
                </div>

                <!-- MAP -->
                <div id="map" class="h-[70vh] lg:h-[100vh] w-full z-0"></div>

                <div class="p-4 bg-white lg:hidden">
                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-full font-semibold shadow-md transition">
                        Simpan Alamat
                    </button>
                </div>

            </div>

            <!-- RIGHT: FORM -->
            <div class="hidden lg:block lg:col-span-4">

                <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm space-y-5">

                    <!-- INFO BOX -->
                    <div class="bg-blue-100 border border-blue-300 text-blue-700 p-3 md:p-4 rounded-lg text-xs md:text-sm">
                        Ketersediaan paket dan harga dapat berubah sesuai titik lokasi pemasangan.
                    </div>

                    <!-- ADDRESS FIELD -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Alamat Lengkap*
                        </label>

                        <p class="text-xs text-gray-500 mb-2">
                            Lengkapi alamat dengan Kel, Kec, RT/RW, dan Kode Pos
                        </p>

                        <textarea name="address" id="adress" rows="3" maxlength="200"
                            class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                            placeholder="Masukkan alamat lengkap..."></textarea>

                    </div>

                </div>

                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

            </div>

        </div>

        <div class="hidden lg:block bg-white p-4 shadow-inner">
            <div class="max-w-7xl mx-auto flex justify-center md:justify-end"> <button type="submit"
                    class="w-full md:w-auto bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-full font-semibold shadow-md transition">
                    Simpan Alamat </button> </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // INIT MAP
            let lat = {{ $lat }}
            let lng = {{ $long }}
            var map = L.map('map', {
                zoomControl: false,
            }).setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);


            var marker = L.marker([lat, lng]).addTo(map);

            // setiap map digeser
            map.on('move', function() {
                marker.setLatLng(map.getCenter());
            });

            var searchInput = document.getElementById('searchAddress');

            // 🔁 Reverse Geocoding
            function getAddress(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.display_name) {
                            document.getElementById('adress').value = data.display_name;
                        }

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;
                    });
            }

            getAddress(lat, lng);

            // 🔍 Forward Geocoding

            function searchLocation(query) {
                fetch(
                        `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=id&limit=1`
                    )
                    .then(res => res.json())
                    .then(data => {
                        if (data.length > 0) {

                            var lat = data[0].lat;
                            var lon = data[0].lon;

                            map.setView([lat, lon], 16);
                            marker.setLatLng([lat, lon]);

                            getAddress(lat, lon);

                        } else {
                            alert("Alamat tidak ditemukan");
                        }
                    });
            }

            // ENTER SEARCH
            let searchTimeout = null;
            let geoTimeout = null;
            let lastRequestTime = 0;

            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    let query = searchInput.value.trim();
                    if (!query) return;
                    searchLocation(query);
                }, 500); // tunggu 1 detik sebelum request
            });

            map.on('moveend', function() {
                clearTimeout(geoTimeout);

                geoTimeout = setTimeout(() => {

                    let now = Date.now();

                    // Batasi minimal 1.2 detik antar request
                    if (now - lastRequestTime < 1200) return;

                    lastRequestTime = now;

                    var center = map.getCenter();
                    getAddress(center.lat, center.lng);

                }, 100);
            });

        });
    </script>
@endsection
