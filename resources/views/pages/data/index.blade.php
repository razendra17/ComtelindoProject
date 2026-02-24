@extends('layouts.app')
@section('content')
    <div class="w-5xl py-3 align-middle justify-center items-center mx-auto flex  ">
        <img src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" alt="" srcset=""
            class="rounded-3xl">
    </div>

    <button id="city-open-modal"
        class="max-w-5xl mx-auto flex mt-6 cursor-pointer border border-amber-500 rounded-xl shadow-2xl ">
        <div class="w-5xl px-4 py-3 text-left text-black">
            <p>Pilih Kota anda</p>
            <p id="current-city" class="text-gray-700"></p>
        </div>
    </button>


    <div id="packageList" class="open-modal grid md:grid-cols-3 gap-4 mt-6 max-w-5xl mx-auto p-4">
    </div>
@endsection
@include('pages.data.modal.city')
@include('pages.data.modal.paket')

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
                    $('#packageList').html(response);
                    $('#city-modal').addClass('hidden');
                }
            });

            let cityName = $('#citySelect option:selected').text();
            $('#current-city').text(cityName);
        });


        $(document).on('click', '.package-card', function() {

            const pkg = JSON.parse($(this).attr('data-package'));

            $('#modalName').text(pkg.name);
            $('#modalSpeed').text(pkg.speed);
            $('#modalDevice').text(pkg.device);
            $('#modalPrice').text(
                new Intl.NumberFormat('id-ID').format(pkg.price)
            );
            const slug = pkg.name.replace(/\s+/g, '-').toLowerCase();
            document.getElementById('choose-package').href = `/data/area/${slug}-${pkg.id}`;
            $('#packageModal').removeClass('hidden');
        });

        $('#close-modal').on('click', function() {
            $('#packageModal').addClass('hidden');
        });

        
    </script>
@endsection
