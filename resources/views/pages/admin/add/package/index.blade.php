@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white rounded-lg shadow p-6">

        <!-- Header -->
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">
                Add Package
            </h2>
            <p class="text-gray-500 text-sm">
                Tambah paket baru
            </p>
        </div>

        <!-- Form -->
        <form action="#" method="POST">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Paket
                    </label>
                    <input type="text" name="name"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="Masukkan nama Paket">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Speed
                    </label>
                    <input type="text" name="brand"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500focus:outline-none"
                        placeholder="Masukkan speed Internet">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Device
                    </label>
                    <input type="text" name="brand"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="Masukkan device">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Harga
                    </label>
                    <input type="number" name="price"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="RP.xxxx">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Kota
                    </label>
                    <select name="city"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                        <option value="">Pilih Kota</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-amber-500 hover:bg-amber-700 text-white px-6 py-2.5 rounded-lg transition">
                    Tambah Paket
                </button>
            </div>

        </form>

    </div>
@endsection
