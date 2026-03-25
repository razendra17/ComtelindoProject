<div class="rounded-2xl border border-gray-200 bg-gray-100 h-full flex flex-col">
  
  <div class="rounded-t-2xl bg-white px-6 py-6 h-full">

    <!-- HEADER -->
    <div class="mb-4">
      <h3 class="text-lg font-semibold text-gray-800">
        Request Target
      </h3>
      <p class="text-sm text-gray-500 mt-1">
        Progress pengajuan bulan ini
      </p>
    </div>

    <!-- CHART -->
    <div class="relative flex items-center justify-center h-[160px]">
      <div  id="chartTwo">
      </div>
    </div>

    <div class="text-center">
      <p class="text-xs text-gray-500">
        dari {{ $target }}
      </p>
    </div>

    <!-- STATUS -->
    <div class="mt-4 text-center">
      <span class="inline-block 
        {{ $percentageChange >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}
        text-xs font-medium px-3 py-1 rounded-full">
        
        {{ $percentageChange >= 0 ? '+' : '' }}{{ $percentageChange }}%
        dari bulan lalu
      </span>
    </div>

  </div>

  <!-- FOOTER -->
  <div class="flex justify-around py-4 bg-gray-50 rounded-b-2xl">

    <div class="text-center">
      <p class="text-xs text-gray-500">Target</p>
      <p class="text-lg font-semibold text-gray-800">{{ $target }}</p>
    </div>

    <div class="w-px bg-gray-200"></div>

    <div class="text-center">
      <p class="text-xs text-gray-500">Tercapai</p>
      <p class="text-lg font-semibold text-green-600">{{ $current }}</p>
    </div>

    <div class="w-px bg-gray-200"></div>

    <div class="text-center">
      <p class="text-xs text-gray-500">Sisa</p>
      <p class="text-lg font-semibold text-red-500">{{ $remaining }}</p>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const target = {{ $target }};
const current = {{ $current }};
const remaining = {{ $remaining }};

const ctx = document.getElementById('chartTwo').getContext('2d');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [current, remaining],
            backgroundColor: ['#f59e0b', '#e5e7eb'],
            borderWidth: 0
        }]
    },
    options: {
        cutout: '75%',
        plugins: {
            tooltip: { enabled: false }
        }
    }
});
</script>