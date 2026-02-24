<div id="packageModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-[400px]">

        

        <h2 id="modalName" class="text-xl font-bold"></h2>
        <p><span id="modalSpeed"></span> Mbps</p>
        <p>Perangkat terhubung: <span id="modalDevice"></span></p>
        <p class="font-bold text-right">Rp <span id="modalPrice"></span></p>

        <hr class="my-4">

        <p class="font-semibold">Biaya pasang Gratis</p>

        <hr class="my-4">

        <p class="font-semibold">Petunjuk umum</p>
        <p class="text-sm">
            1. Pembayaran internet terdiri dari biaya instalasi dan tagihan bulanan.
            2. Instalasi dibayarkan setelah selesai.
            3. Tagihan bulanan tanggal 5-20.
        </p>

        <button onclick="closeModal()" class="mt-4 bg-orange-500 text-white px-4 py-2 rounded">
            pilih paket
        </button>

    </div>
</div>

<script>
    const modal = document.getElementById('packageModal');

    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', function() {

            document.getElementById('modalName').innerText = this.dataset.name;
            document.getElementById('modalSpeed').innerText = this.dataset.speed;
            document.getElementById('modalDevice').innerText = this.dataset.device;
            document.getElementById('modalPrice').innerText =
                new Intl.NumberFormat('id-ID').format(this.dataset.price);

            modal.classList.remove('hidden');
        });
    });

    function closeModal() {
        modal.classList.add('hidden');
    }
</script>

{{-- @foreach($packages as $package)
    <button 
        class="open-modal"
        data-name="{{ $package->name }}"
        data-price="{{ $package->price }}"
        data-speed="{{ $package->speed }}"
        data-device="{{ $package->device }}"
    >
        {{ ucfirst($package->name) }}
    </button>
@endforeach --}}


