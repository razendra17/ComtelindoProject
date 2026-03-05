@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">

        <!-- Image -->
        <div class="w-64 h-40 overflow-hidden rounded-xl">
            <img src="{{ asset('assets/Gemini_Generated_Image_jily1ojily1ojily-removebg-preview.png') }}"
                 class="w-full h-full object-cover">
        </div>
        <!-- Form Card -->
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">

            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-[#ff8521]">Welcome Back</h1>
                <p class="text-gray-500 text-sm mt-2">
                    Silakan login ke akun Anda
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full mt-1 px-4 py-3 border rounded-xl 
                    focus:ring-2 focus:ring-[#ff8521] 
                    focus:border-[#ff8521] outline-none transition">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-1 px-4 py-3 border rounded-xl 
                    focus:ring-2 focus:ring-[#ff8521] 
                    focus:border-[#ff8521] outline-none transition">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember" class="rounded text-[#ff8521] focus:ring-[#ff8521]">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[#ff8521] hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-[#ff8521] hover:bg-orange-600 
                text-white py-3 rounded-xl font-semibold 
                transition duration-300 shadow-md hover:shadow-lg">
                    Log In
                </button>
            </form>

        </div>
    </div>
@endsection
