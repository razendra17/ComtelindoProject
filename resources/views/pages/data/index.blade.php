@extends('layouts.app')
@section('content')

    <!-- Banner -->
    <div class="max-w-5xl w-full px-4 py-3 mx-auto flex justify-center">
        <img 
            src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" 
            alt=""
            class="w-full rounded-3xl object-cover"
        >
    </div>

    <!-- Button Pilih Kota -->
    <div class="max-w-5xl w-full px-4 mx-auto mt-6">
        <button id="city-open-modal"
            class="w-full border border-amber-500 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
            
            <div class="px-4 py-3 text-left">
                <p class="font-medium text-black">
                    Pilih Kota anda
                </p>
                <p id="current-city" class="text-gray-600 text-sm mt-1"></p>
            </div>

        </button>
    </div>

    <!-- Package List -->
    <div id="packageList"
        class="max-w-5xl w-full mx-auto mt-8 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
