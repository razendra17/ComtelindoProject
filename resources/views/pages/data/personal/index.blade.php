@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            <!-- LEFT SIDE (Hidden on Mobile) -->
            <div class="hidden lg:flex flex-col gap-6">

                <!-- Gambar Box -->
                <div class=" rounded-2xl h-64 flex items-center justify-center text-black font-semibold">
                    <img src="{{ asset('assets/Gemini_Generated_Image_jily1ojily1ojily-removebg-preview.png') }}"
                        alt="" srcset="">
                </div>

                <!-- Kata2 Box -->
                <div class="bg-[#ffffff] rounded-2xl h-32 flex items-center justify-center text-black w-3/4">
                    <p class="w-[90%] text-gray-700">
                        Nikmati koneksi stabil dengan kecepatan tinggi untuk streaming, gaming, dan bekerja tanpa gangguan.
                        Saatnya beralih ke jaringan yang benar-benar bisa diandalkan.
                    </p>
                </div>

            </div>

            <!-- RIGHT SIDE (Form) -->
            <div class="w-full bg-white rounded-2xl shadow-xl p-3">

                <h2 class="text-2xl font-bold text-center text-[#DE5727] mb-6">
                   Data Diri
                </h2>

                <form action="#" method="POST" class="space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720]">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Email
                        </label>
                        <input type="email" name="email"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720]">
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Nomor Hp
                        </label>
                        <input type="tel" name="number" placeholder="+62"
                            class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720]">
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-[#DE5727] mb-1">
                            Alamat
                        </label>

                        <textarea class="w-full px-4 py-2 border border-[#ED9720] rounded-lg bg-gray-100" readonly>{{ $address }}</textarea>

                        <input type="hidden" name="address" value="{{ $address }}">
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

                    <button type="submit"
                        class="w-full bg-[#DE5727] text-white font-semibold py-2.5 rounded-xl hover:bg-[#c94e1f] transition">
                        Submit
                    </button>

                </form>
            </div>

        </div>
    </div>
@endsection
