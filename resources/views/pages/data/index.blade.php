@extends('layouts.app')
@section('content')
    <div class="w-5xl py-3 align-middle justify-center items-center mx-auto flex  ">
        <img src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" alt="" srcset=""
            class="rounded-3xl">
    </div>

    <button id="city-open-modal"
        class="max-w-5xl mx-auto flex mt-6 cursor-pointer border border-amber-500 rounded-xl shadow-2xl ">
        <div class="w-5xl px-4 py-3 text-left">
            <p>Pilih Kota anda</p>
            <p id="current-city" class="text-gray-700"></p>
        </div>
    </button>

    <div id="packageList" class="grid md:grid-cols-3 gap-4 mt-6 max-w-5xl mx-auto p-4">

    </div>
@endsection
@include('pages.data.modal.city')

@section('script')
    <script>
        $('#city-open-modal').on('click', function() {
            $('#city-modal').removeClass('hidden');
        });

        $('#select-location').on('click', function() {
            let cityId = $('#citySelect').val();
            if (!cityId) {
                toastr.error('Pilih kota dulu!', 'Lokasi Belum Dipilih');
                return;
            }

            $.ajax({
                url: '/data/by-city/' + cityId,
                type: 'GET',
                success: function(response) {

                    toastr.success('Paket berhasil dimuat 🎉', 'Berhasil');

                    let html = '';

                    response.forEach(function(pkg) {
                        html += `
                    @include('pages.data.package')
                `;
                    });

                    $('#packageList').html(html);

                    $('#city-modal').addClass('hidden');
                }
            });
            let cityName = $('#citySelect option:selected').text();
            $('#current-city').text(cityName);
        });
    </script>
@endsection
