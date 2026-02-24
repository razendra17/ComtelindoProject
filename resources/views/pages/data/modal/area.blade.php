@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">

        <!-- HEADER -->
        <div class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-xl cursor-pointer">←</span>
                <h1 class="font-semibold text-lg">
                    Atur Lokasi Pemasangan
                </h1>
            </div>

            <!-- STEP PROGRESS -->
            <div class="flex items-center gap-6 text-sm">
                <div class="flex items-center gap-2 text-green-600 font-medium">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-green-600">
                        1
                    </span>
                    Lokasi Pemasangan
                </div>

                <div class="flex items-center gap-2 text-gray-400">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border">
                        2
                    </span>
                    Data Diri
                </div>

                <div class="flex items-center gap-2 text-gray-400">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border">
                        3
                    </span>
                    Checkout
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-8 grid grid-cols-12 gap-6">

            <!-- LEFT: MAP -->

            <div class="col-span-8 bg-white rounded-xl shadow-sm overflow-hidden relative">
                <div class="absolute top-4 left-4 right-4 z-10">
                    <input id="searchAddress" type="text" placeholder="Cari alamat"
                        class="w-[90%] mx-auto flex bg-white rounded-full px-5 py-3 shadow focus:outline-none">
                </div>
                <!-- SEARCH BAR -->


                <!-- MAP -->
                <div id="map" class="h-[500px] w-full rounded-xl z-0"></div>
            </div>

            <!-- RIGHT: FORM -->
            <div class="col-span-4">

                <div class="bg-white p-6 rounded-xl shadow-sm space-y-6">

                    <!-- INFO BOX -->
                    <div class="bg-blue-100 border border-blue-300 text-blue-700 p-4 rounded-lg text-sm">
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

                        <textarea id="adress" rows="4"
                            class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                            placeholder="Masukkan alamat lengkap..."></textarea>

                        <div class="text-right text-xs text-gray-400 mt-1">
                            0/200
                        </div>
                    </div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                </div>

            </div>

        </div>

        <!-- BOTTOM FIXED BUTTON -->
        <div class="fixed bottom-0 left-0 right-0 bg-white p-4 shadow-inner flex justify-end">
            <button
                class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-full font-semibold shadow-md transition">
                Simpan Alamat
            </button>
        </div>

    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // INIT MAP
            var map = L.map('map').setView([-6.200000, 106.816666], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([-6.200000, 106.816666], {
                draggable: true
            }).addTo(map);

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

            // 🔍 Forward Geocoding
            const defaultCity = "{{ $city }}";
            function searchLocation(query) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}, ${defaultCity}&countrycodes=id&limit=1`)
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
            let timeout = null;
            searchInput.addEventListener('keyup', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    let query = searchInput.value.trim();
                    if (!query) return;
                    searchLocation(query);
                }, 1000); // tunggu 1 detik sebelum request
            });

            // DRAG MARKER
            marker.on('dragend', function() {
                var latlng = marker.getLatLng();
                getAddress(latlng.lat, latlng.lng);
            });

            // CLICK MAP
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                getAddress(e.latlng.lat, e.latlng.lng);
            });
            
        });
    </script>
@endsection
