<div id="packageModal" 
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

    <div class="relative w-full max-w-xl 
                bg-[#ffffff] 
                rounded-[40px] 
                p-8 
                shadow-2xl 
                animate-fadeIn">

        <!-- HEADER -->
        <div class="flex justify-between items-start my-4">
            <div>
                <h2 id="modalName" class="text-lg font-semibold text-gray-800">
                </h2>
                <p class="text-2xl font-bold text-gray-900">
                    <span id="modalSpeed"></span> Mbps
                </p>
            </div>

            <div class="text-right">
                <p id="modalPrice" class="text-xl font-semibold text-gray-900">
                </p>
                <p class="text-sm text-gray-700">
                    optimal device: <span id="modalDevice"></span>
                </p>
            </div>
        </div>

        <hr class="my-5 border-gray-500/40">

        <!-- INSTALLATION -->
        <p class="text-base font-medium text-gray-800">
            Biaya pasang
        </p>
        <p class="text-base text-gray-900 font-semibold">
            Gratis
        </p>

        <hr class="my-5 border-gray-500/40">

        <!-- PETUNJUK -->
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
            Petunjuk umum
        </h3>

        <ol class="text-sm text-gray-800 space-y-1 leading-relaxed">
            <li>1. Pembayaran internet terdiri dari biaya instalasi & tagihan bulanan.</li>
            <li>2. Instalasi dibayarkan setelah selesai.</li>
            <li>3. Tagihan bulanan setiap tanggal 5–20.</li>
        </ol>

        <!-- BUTTON -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('area.index') }}" id="choose-package"
                class="bg-orange-500 hover:bg-orange-600 
                       transition 
                       text-white 
                       px-8 py-3 
                       rounded-full 
                       font-semibold 
                       shadow-lg">
                pilih paket
        </a>
        </div>

        <!-- CLOSE ICON -->
        <button id="close-modal"
            class="absolute top-5 right-6 text-gray-700 hover:text-black text-xl">
            ✕
        </button>

    </div>
</div>
