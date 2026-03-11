@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-sm px-4 md:px-8 py-4">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- Title -->
            <div class="flex items-center gap-3">
                <span><a href="{{ url()->previous() }}"class="text-xl cursor-pointer">←</a></span>
                <h1 class="font-semibold text-lg">
                    Data diri anda
                </h1>
            </div>

            <!-- STEP PROGRESS -->
            <div class="flex items-center gap-4 text-xs sm:text-sm overflow-x-auto">

                <div class="flex items-center gap-2 text-gray-400 font-medium whitespace-nowrap">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border border-gray-400">
                        1
                    </span>
                    Lokasi
                </div>

                <div class="flex items-center gap-2 text-green-600 whitespace-nowrap">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-green-600">
                        2
                    </span>
                    Data Diri
                </div>

                <div class="flex items-center gap-2 text-gray-400 whitespace-nowrap">
                    <span class="w-6 h-6 flex items-center justify-center rounded-full border border-gray-400">
                        3
                    </span>
                    Kirim
                </div>

            </div>

        </div>
    </div>
    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            <!-- LEFT SIDE (Hidden on Mobile) -->
            <div class="hidden lg:flex flex-col gap-6">

                <!-- Gambar Box -->
                <div class=" rounded-2xl h-64 flex items-center justify-center text-black font-semibold">
                    <img src="{{ asset('assets/Gemini_Generated_Image_jily1ojily1ojily-removebg-preview.png') }}"
                        alt="" srcset="">
                </div>

                <!-- Icon Block -->
                <div class="bg-white p-6 rounded-xl shadow-md space-y-8">

                    <!-- Icon Block -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-[#DE5727]" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>

                        <div class="grow">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Your One Stop Internet Solutions
                            </h3>
                            <p class="mt-1 text-gray-500">
                                Solusi jaringan satu atap untuk mendukung aktivitas Anda dengan layanan internet
                                berkualitas,
                                dan infrastruktur jaringan yang terpercaya.
                            </p>
                        </div>
                    </div>

                    <!-- Icon Block -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-[#DE5727]" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>

                        <div class="grow">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Internet Cepat Anti Lelet
                            </h3>
                            <p class="mt-1 text-gray-500">
                                Internetmu lelet? Nikmati internet cepat anti lelet yang Intynet berikan.

                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT SIDE (Form) -->
            <div class="w-full bg-white rounded-2xl shadow-xl p-3">

                <h2 class="text-2xl font-bold text-center text-[#DE5727] mb-6">
                    Data Pelanggan
                </h2>

                <form id="personalForm" action="{{ route('personal.store', $slug) }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Nama Lengkap <span class="bintang">*</span>
                        </label>
                        <input type="text" name="name" placeholder="Nama Lengkap Anda"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720]  placeholder:text-gray-400">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Email <span class="bintang">*</span>
                        </label>
                        <input type="email" name="email" placeholder="Example@mail.com"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720]  placeholder:text-gray-400">
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Nomor Hp <span class="bintang">*</span>
                        </label>

                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-700 bg-gray-100 border border-r-0 border-[#ED9720] rounded-l-lg">
                                +62
                            </span>
                            <input type="tel" name="number" placeholder="Contoh : 85754313659"
                                class="w-full px-4 py-2 border border-[#ED9720] rounded-r-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720] placeholder:text-gray-400"
                                pattern="[0-9]*" required>
                        </div>
                    </div>

                    <!-- Alamat dari Map (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Alamat
                        </label>

                        <textarea class="w-full px-4 py-2 border border-[#ED9720] rounded-lg bg-gray-100" readonly>{{ $address }}</textarea>

                        <input type="hidden" name="address" value="{{ $address }}">
                    </div>


                    <!-- Alamat Detail -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Alamat Detail (Warna rumah, gang, patokan dll)
                        </label>

                        <textarea name="address_detail" placeholder="Contoh: Rumah warna biru, gang sebelah masjid"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg"></textarea>
                    </div>

                    <!-- Package -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Paket
                        </label>

                        <input type="text" value="{{ $package->name }}"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg bg-gray-100" readonly>

                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                    </div>
                    <input type="hidden" name="latitude" value="{{ $latitude }}">
            </div>
        </div>
        <input type="hidden" name="longitude" value="{{ $longitude }}">
    </div>



    <button type="submit"
        class="w-full bg-[#DE5727] text-white font-semibold py-2.5 rounded-xl hover:bg-[#c94e1f] transition">
        Submit
    </button>


    </form>
    </div>

    </div>
    </div>
@endsection
@section('script')
@section('script')
    <script>
        $(document).ready(function() {

            $('#personalForm').on('submit', function(e) {
                e.preventDefault(); // CEGAH RELOAD

                let form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {

                        toastr.success(response.message);

                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1000); // delay 1 detik biar toastr sempat kebaca
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            // ambil error pertama saja
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
