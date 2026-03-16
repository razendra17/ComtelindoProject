@extends('layouts.app')
@section('content')
    <!-- Banner -->
    <div class="max-w-5xl w-[full] mx-auto flex justify-center lg:py-3">
        <img src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" alt=""
            class="w-full  lg:rounded-3xl object-cover">
    </div>

    <!-- Button Pilih Kota -->
    <div class=" px-3 justify-center items-center mx-auto flex mt-6">
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

    <!-- Package List -->
    <div id="packageList" class="max-w-5xl w-full mx-auto mt-8 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>
@endsection
@include('pages.user.modal.paket')

@section('script')
    <script>
        $(document).ready(function() {

            let citySelected = false; // default belum pilih kota
            // Pilih lokasi


            $('#citySelect').on('change', function() {

                let cityId = $(this).val();

                let cityName = $(this).find('option:selected').text();

                $.ajax({
                    url: '/user/by-city/' + cityId,
                    type: 'GET',
                    success: function(response) {

                        citySelected = true;

                        toastr.success('Paket berhasil di load!');

                        $('#packageList').html(response);

                        $('#current-city').text(cityName);
                    }
                });

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
