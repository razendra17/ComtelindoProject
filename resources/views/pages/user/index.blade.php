@extends('layouts.app')
@section('content')
    <!-- Banner -->
    <div class="max-w-5xl w-[full] mx-auto flex justify-center lg:py-3">
        <img src="{{ asset('assets/Gemini_Generated_Image_8es1qg8es1qg8es1.png') }}" alt=""
            class="w-full  lg:rounded-3xl object-cover">
    </div>

    <!-- Button Pilih Kota -->
    <div class=" px-3 justify-center items-center mx-auto flex mt-6 ">
        <select id="citySelect"
            class="city-select w-5xl ">
            <option value="">Pilih Kota</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="px-3">
        <div id="toast-warning"
            class="w-full max-w-5xl my-3 p-4 mb-4 text-sm text-fg-warning rounded-base bg-[#ff700a30] border border-warning-subtle m-auto"
            role="alert">
            <div class="flex items-center justify-between">
                <div class="flex items-center" onclick="addClass(hidden)">
                    <svg class="w-4 h-4 shrink-0 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="font-semibold">Pilih kota tujuan anda</h3>
                </div>
                <button type="button" data-dismiss-target="#toast-warning" aria-label="Close"
                    class="ms-auto -mx-1.5 -my-1.5 bg-warning-soft text-fg-warning-strong rounded focus:ring-2 focus:ring-warning-medium p-1.5 hover:bg-warning-medium inline-flex items-center justify-center h-8 w-8">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>
            </div>
            <div class="mt-2 mb-4">
                Pilih kota tujuan anda untuk melihat list dan harga paket yang akan tertera di bawah ini, harga paket yang
                tertera
                di bawah dapat berubah menyesuaikan mobilitas daerah tersebut. pengajuan TIDAK melakukan BIAYA TRANSAKSI
                apapun
            </div>
        </div>
    </div>
    <!-- Package List -->
    <div class="px-3">
        <div id="packageList" class="max-w-5xl w-full mx-auto mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 ">
        </div>
    </div>
@endsection

{{-- modal --}}
@section('modal')
    @include('pages.user.modal.paket')
@endsection

{{-- script --}}
@section('script')
    <script>
        $(document).ready(function() {

            let citySelected = false; // default belum pilih kota
            // Pilih lokasi


            $('#citySelect').on('change', function() {

                let cityId = $(this).val();

                let cityName = $(this).find('option:selected').text();

                $.ajax({
                    url: '/by-city/' + cityId,
                    type: 'GET',
                    success: function(response) {

                        citySelected = true;

                        toastr.success('Paket berhasil di load!');
                            
                        $('#packageList').html(response);
                        $('#current-city').text(cityName);
                    }
                });

            });
            const modal = document.getElementById("locationModal")
            const content = document.getElementById("modalContent")

            new TomSelect("#citySelect", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Pilih Kota Tujuan",
                allowEmptyOption: true
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
                    `/area/${slug}-${pkg.id}`;

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
