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

                <!-- SEARCH BAR -->
                <div class="absolute top-4 left-4 right-4 z-10">
                    <input type="text" placeholder="Cari alamat"
                        class="w-full bg-white rounded-full px-5 py-3 shadow focus:outline-none">
                </div>

                <!-- MAP -->
                <div id="map" class="h-[500px] w-full rounded-xl"></div>
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

                        <textarea rows="4" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                            placeholder="Masukkan alamat lengkap..."></textarea>

                        <div class="text-right text-xs text-gray-400 mt-1">
                            0/200
                        </div>
                    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var map = L.map('map').setView([-6.200000, 106.816666], 13); // Jakarta default

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([-6.200000, 106.816666], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function(e) {
                var latlng = marker.getLatLng();
                console.log(latlng.lat, latlng.lng);
            });

        });
    </script>
@endsection
