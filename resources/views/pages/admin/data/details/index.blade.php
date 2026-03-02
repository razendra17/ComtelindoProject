@extends('layouts.app')
@section('content')

<div class="min-h-screen bg-gray-100 py-10 px-6">

    {{-- Title --}}
    <div class="flex justify-center mb-10">
        <div class="bg-gray-300 text-gray-600 font-semibold px-10 py-2 rounded-full shadow-sm">
            Details of {{ $data->customer_id }} submission
        </div>
    </div>

    {{-- Content --}}
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-start">

        {{-- LEFT : MAP --}}
        <div class="bg-gray-30 z-1 rounded-3xl h-[350px] relative overflow-hidden shadow-inner">
            <div id="map" class="w-full h-full"></div>

            <div class=" absolute inset-0 flex items-center justify-center pointer-events-none">
                <span class="text-gray-600 font-medium">
                    map from city and adress
                </span>
            </div>
        </div>

        {{-- RIGHT : DETAILS CARD --}}
        <div class="bg-gray-300 rounded-2xl p-6 shadow">

            <div class="space-y-2 text-gray-700 text-sm">
                <p><span class="font-semibold">customer id:</span> {{ $data->customer_id }}</p>
                <p><span class="font-semibold">name:</span> {{ $data->name }}</p>
                <p><span class="font-semibold">package:</span> {{ $package->name }}</p>
                <p><span class="font-semibold">city:</span> {{ $city->name }}</p>
                <p><span class="font-semibold">address:</span> {{ $data->address }}</p>

                <div class="pt-4">
                    <p class="font-semibold">Contact</p>
                    <p>phone number: {{ $data->number }}</p>
                    <p>email: {{ $data->email }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-6xl mx-auto flex justify-end mt-20">
        <a href="{{ url()->previous() }}"
           class="bg-gray-300 hover:bg-gray-350
                  text-gray-600 text-sm font-medium
                  px-8 py-2 rounded-full
                  shadow-inner transition duration-200">
            back
        </a>
    </div>

    {{-- Hidden Inputs --}}
    <input type="hidden" id="latitude">
    <input type="hidden" id="longitude">
    <input type="hidden" id="adress">

</div>


{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const lat = @json($data->latitude);
    const long = @json($data->longitude);

    const map = L.map('map', {
        scrollWheelZoom: true,  // tetap bisa zoom pakai scroll
        doubleClickZoom: true,
        boxZoom: false,
        keyboard: false,
        zoomControl: true,      // tombol + -
        tap: false
    }).setView([lat, long], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker tetap
    L.marker([lat, long]).addTo(map);

</script>

@endsection