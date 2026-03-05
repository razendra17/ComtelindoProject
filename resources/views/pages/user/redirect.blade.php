@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen">

    <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl p-10 text-center">
        
        <div class="mx-auto mb-6 w-20 h-20 flex items-center justify-center 
                    rounded-full bg-orange-100">
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="w-10 h-10 text-[#ff8521]" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor" 
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-[#ff8521] mb-4">
            Terima Kasih!
        </h1>

        <!-- Message -->
        <p class="text-gray-600 mb-8 leading-relaxed">
            Terimakasih telah mengisi data! <br>
            Silahkan menunggu respond yang akan dikirim ke email Anda.
        </p>

        <!-- Button -->
        <a href="{{ url('/') }}"
           class="inline-block bg-[#ff8521] hover:bg-orange-600 
                  text-white px-8 py-3 rounded-xl 
                  font-semibold transition duration-300 
                  shadow-md hover:shadow-lg">
            Kembali ke Halaman Awal
        </a>

    </div>

</div>
@endsection