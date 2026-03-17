@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-6">

        {{-- Title --}}
        <div class="flex justify-center mb-10">
            <div class="bg-amber-500 text-white font-semibold px-8 py-3 rounded-full shadow-md text-sm tracking-wide">
                Details of {{ $data->customer_id }} Submission
            </div>
        </div>

        {{-- Content --}}
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-start">

            {{-- LEFT : MAP --}}
            <div class="bg-white rounded-3xl h-[380px] relative overflow-hidden shadow-lg border border-gray-200">

                <div id="map" class="w-full h-full"></div>

                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <span class="text-gray-400 text-sm">
                        Map from City and Address
                    </span>
                </div>

            </div>

            {{-- RIGHT : DETAILS CARD --}}
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-200">

                {{-- Section Title --}}
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-700">
                        Customer Information
                    </h2>

                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-700">
                        Submission Data
                    </span>
                </div>

                <div class="space-y-4 text-sm text-gray-700">

                    <div class="flex justify-between">
                        <span class="font-medium text-gray-500">Customer ID</span>
                        <span>{{ $data->customer_id }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-medium text-gray-500">Name</span>
                        <span>{{ $data->name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-medium text-gray-500">Package</span>
                        <span>{{ $package->name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-medium text-gray-500">City</span>
                        <span>{{ $city->name }}</span>
                    </div>

                    <div>
                        <p class="font-medium text-gray-500 mb-1">Address</p>
                        <p class="text-gray-700">{{ $data->address }}</p>
                    </div>

                    <div class="pt-6 border-t border-gray-200">

                        <p class="font-semibold text-gray-600 mb-3">
                            Contact
                        </p>

                        <div class="space-y-2">
                            <p class="flex justify-between">
                                <span class="text-gray-500">Phone</span>
                                <span>{{ $data->number }}</span>
                            </p>

                            <p class="flex justify-between">
                                <span class="text-gray-500">Email</span>
                                <span>{{ $data->email }}</span>
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        {{-- Back Button --}}
        <div class="max-w-6xl mx-auto flex justify-end mt-16">

            <a href="{{ url()->previous() }}"
                class="bg-white hover:bg-amber-500
                  text-gray-700 hover:text-white
                  text-sm font-medium
                  px-8 py-2.5 rounded-full
                  border border-gray-300
                  shadow-sm transition duration-200">

                Back

            </a>

        </div>

    </div>

    {{-- Hidden Inputs --}}
    <input type="hidden" id="latitude">
    <input type="hidden" id="longitude">
    <input type="hidden" id="adress"> </div>

    {{-- Leaflet JS --}}
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

     <script> const lat = @json($data->latitude); const long = @json($data->longitude); const map = L.map('map', { scrollWheelZoom: true,  doubleClickZoom: true, boxZoom: false, keyboard: false, zoomControl: true,  tap: false }).setView([lat, long], 15); L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map); L.marker([lat, long]).addTo(map); </script>
       @endsection