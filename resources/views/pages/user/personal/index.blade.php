@include('pages.user.modal.thanks')
@extends('layouts.app')

@section('content')
    <!-- HEADER -->
    <div class="bg-white shadow-sm px-4 md:px-8 py-3 md:py-4">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <!-- Title -->
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}" class="text-lg md:text-xl">←</a>

                <h1 class="font-semibold text-base md:text-lg">
                    Data diri anda
                </h1>
            </div>

            <!-- STEP -->
            <div class="flex items-center gap-3 text-xs sm:text-sm overflow-x-auto">

                <div class="flex items-center gap-2 text-gray-400 whitespace-nowrap">
                    <span class="w-5 h-5 flex items-center justify-center rounded-full border text-xs">
                        1
                    </span>
                    Lokasi
                </div>

                <div class="flex items-center gap-2 text-green-600 whitespace-nowrap">
                    <span class="w-5 h-5 flex items-center justify-center rounded-full border-2 border-green-600 text-xs">
                        2
                    </span>
                    Data Diri
                </div>

                <div class="flex items-center gap-2 text-gray-400 whitespace-nowrap">
                    <span class="w-5 h-5 flex items-center justify-center rounded-full border text-xs">
                        3
                    </span>
                    Kirim
                </div>

            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="min-h-screen py-6 md:py-10">

        <div class="w-full lg:max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-3 lg:gap-8 items-start">

            <!-- LEFT SIDE -->
            <div class="hidden lg:flex flex-col gap-6">

                <div class="rounded-2xl h-64 flex items-center justify-center">
                    <img src="{{ asset('assets/Gemini_Generated_Image_jily1ojily1ojily-removebg-preview.png') }}">
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md space-y-6">

                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-[#DE5727]" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>

                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Your One Stop Internet Solutions
                            </h3>
                            <p class="text-gray-500 text-sm">
                                Solusi jaringan satu atap untuk mendukung aktivitas Anda.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-[#DE5727]" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>

                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Internet Cepat Anti Lelet
                            </h3>
                            <p class="text-gray-500 text-sm">
                                Nikmati internet cepat anti lelet dari Intynet.
                            </p>
                        </div>
                    </div>

                </div>

            </div>


            <!-- FORM -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg md:shadow-xl p-6 md:p-6">

                <h2 class="text-xl md:text-2xl font-bold text-center text-[#DE5727] mb-5 md:mb-6">
                    Data Pelanggan
                </h2>

                <form id="personalForm" action="{{ route('personal.store', $slug) }}" method="POST" class="space-y-4 md:space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="text-sm font-medium text-[#DE5727]">
                            Nama Lengkap *
                        </label>

                        <input type="text" name="name" placeholder="Nama Lengkap Anda"
                            class="mt-1 w-full px-3 py-2 text-sm border border-[#ED9720] rounded-lg focus:ring-2 focus:ring-[#ED9720]">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium text-[#DE5727]">
                            Email *
                        </label>

                        <input type="email" name="email" placeholder="example@mail.com"
                            class="mt-1 w-full px-3 py-2 text-sm border border-[#ED9720] rounded-lg focus:ring-2 focus:ring-[#ED9720]">
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="text-sm font-medium text-[#DE5727]">
                            Nomor Hp *
                        </label>

                        <div class="flex mt-1">

                            <span
                                class="px-3 flex items-center text-sm bg-gray-100 border border-r-0 border-[#ED9720] rounded-l-lg">
                                +62
                            </span>

                            <input type="tel" name="number" placeholder="857xxxx"
                                class="w-full px-3 py-2 text-sm border border-[#ED9720] rounded-r-lg focus:ring-2 focus:ring-[#ED9720]">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="text-sm font-medium text-[#DE5727]">
                            Alamat
                        </label>

                        <textarea class="h-32 mt-1 w-full px-3 py-2 text-sm border border-[#ED9720] rounded-lg bg-gray-100" readonly>{{ $address }}</textarea>

                        <input type="hidden" name="address" value="{{ $address }}">
                    </div>

                    <!-- Detail -->
                    <div>
                        <label class="text-sm font-medium text-[#DE5727]">
                            Alamat Detail
                        </label>

                        <textarea name="address_detail" placeholder="Rumah warna biru, dekat masjid"
                            class="mt-1 w-full px-3 py-2 text-sm border border-[#ED9720] rounded-lg"></textarea>
                    </div>

                    <!-- Paket -->
                    <div>
                        <label class="text-sm font-medium text-[#DE5727]">
                            Paket
                        </label>

                        <input type="text" value="{{ $package->name }}"
                            class="mt-1 w-full px-3 py-2 text-sm border border-[#ED9720] rounded-lg bg-gray-100" readonly>

                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                    </div>

                    <input type="hidden" name="latitude" value="{{ $latitude }}">
                    <input type="hidden" name="longitude" value="{{ $longitude }}">

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full mt-4 bg-[#DE5727] text-white text-sm md:text-base font-semibold py-2.5 md:py-3 rounded-xl hover:bg-[#c94e1f] transition">
                        Lanjutkan
                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#personalForm').on('submit', function(e) {
                e.preventDefault(); // CEGAH RELOAD PAGE

                let form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),

                    success: function(response) {

                        // notifikasi sukses
                        toastr.success(response.message);

                        // tampilkan popup setelah sebentar
                        setTimeout(function() {
                            $('#successModal')
                                .removeClass('hidden')
                                .addClass('flex');
                        }, 700);

                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            // ambil error pertama
                            let firstError = Object.values(errors)[0][0];

                            toastr.error(firstError);

                        } else {

                            toastr.error("Terjadi kesalahan server");

                        }

                    }
                });

            });

        });
    </script>
@endsection
