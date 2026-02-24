<div id="city-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-[#ffffff] w-[420px] rounded-3xl p-8 relative shadow-xl">

        {{-- SLOT GAMBAR --}}
        <div class="flex justify-center mb-4">
            <img src=" {{ asset('assets/maskot-removebg-preview.png') }}" alt="" srcset="" class="">
        </div>

        {{-- TITLE --}}
        <h2 class="text-center text-lg font-semibold">
            Atur lokasi pemasangan dulu yah!
        </h2>

        <p class="text-center text-sm text-gray-700 mb-6">
            tentukan lokasi anda untuk paket yang tersedia!
        </p>
        <div class="max-w-5xl justify-center items-center mx-auto flex mt-6">
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

        <button id="select-location" class="flex py-2 mx-auto my-auto cursor-pointer">
            <div class=" bg-amber-400 w-34 h-10 rounded-2xl text-amber-50 alingn-middle items-center justify-center flex">
                <p class="mx-auto my-auto flex">Pilih lokasi</p>
            </div>
        </button>
    </div>
</div>

