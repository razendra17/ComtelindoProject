@if (!session('city_id'))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

        <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8 relative">

            <!-- Title -->
            <h2 class="text-xl font-bold text-center text-[#DE5727] mb-2">
                Atur lokasi pemasangan dulu yah!
            </h2>

            <p class="text-sm text-gray-500 text-center mb-6">
                Tentukan lokasi anda untuk paket yang tersedia
            </p>

            <form action="{{ route('set.city') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-[#DE5727] mb-1">
                        Kota *
                    </label>

                    <select name="city_id"
                        class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:ring-2 focus:ring-[#ED9720] focus:outline-none">

                        <option value="">Pilih Kota</option>

                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ $city->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-[#DE5727] text-white py-2.5 rounded-xl hover:bg-[#c94e1f] transition">
                    Pilih Kota
                </button>

            </form>

        </div>

    </div>
@endif
