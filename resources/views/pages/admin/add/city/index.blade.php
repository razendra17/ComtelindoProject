@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white rounded-lg shadow p-6">

        <!-- Header -->
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">
                Add City
            </h2>
            <p class="text-gray-500 text-sm">
                Tambah kota baru
            </p>
        </div>

        <!-- Form -->
        <form id="cityForm" action="{{ route('cities.store') }}" method="POST">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-2">

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Kota
                    </label>
                    <input type="text" name="name"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="Masukkan nama Kota">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Area / Provinsi
                    </label>
                    <input type="text" name="area"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="Masukkan nama Provinsi">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Latitude
                    </label>
                    <input type="text" name="latitude"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="Masukkan Latitude">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Longitude
                    </label>
                    <input type="text" name="longitude"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                        placeholder="Masukkan Longitude">
                </div>


                <div class= "justify-end">
                    <button type="submit"
                        class="bg-amber-500 hover:bg-amber-700 item text-white px-6 py-2.5 rounded-lg transition">
                        Tambah Kota
                    </button>
                </div>

        </form>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#cityForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {

                        toastr.success(response.message);

                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1200);
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
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
