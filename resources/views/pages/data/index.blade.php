@extends('layouts.app')
@section('content')
    <div class="w-5xl py-3 align-middle justify-center items-center mx-auto flex  ">
        <img src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" alt="" srcset=""
            class="rounded-3xl">
    </div>

    <div class="max-w-5xl justify-center items-center mx-auto flex mt-6">
        <select id="citySelect"
            class="w-5xl border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400">
            <option value="">Pilih Kota</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div id="packageList" class="grid md:grid-cols-3 gap-4 mt-6 max-w-5xl mx-auto p-4">

    </div>
@endsection

@section('script')
    <script>
        const cities = @json($cities);

        const citySelect = document.getElementById('citySelect');
        const packageList = document.getElementById('packageList');

        citySelect.addEventListener('change', function() {

            const cityId = this.value;
            packageList.innerHTML = '';

            if (!cityId) return;

            const selectedCity = cities.find(c => c.id == cityId);

            selectedCity.packages.forEach(pkg => {

                packageList.innerHTML += `
                    @include('pages.data.package')
            `;

            });

        });
    </script>
@endsection
