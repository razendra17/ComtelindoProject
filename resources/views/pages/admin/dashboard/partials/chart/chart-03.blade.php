<div class="rounded-2xl border border-gray-200 bg-white px-5 pt-5 pb-5 sm:px-6 sm:pt-6">

    <!-- HEADER -->
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">

        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Statistics
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Data pengajuan berdasarkan waktu
            </p>
        </div>

        <!-- FILTER BUTTON -->
        <div class="flex gap-2">
            <button class="filter-btn px-4 py-1.5 rounded-lg bg-amber-500 text-white" data-filter="month">
                Month
            </button>
            <button class="filter-btn px-4 py-1.5 rounded-lg bg-gray-200 text-gray-700" data-filter="week">
                Week
            </button>
            <button class="filter-btn px-4 py-1.5 rounded-lg bg-gray-200 text-gray-700" data-filter="day">
                Day
            </button>
        </div>

    </div>

    <!-- CHART -->
    <div class="w-full">
        <canvas id="chartThree" height="100"></canvas>
    </div>

</div>
<script>
let chart;

// format jam hanya untuk day
function formatHourLabels(labels, filter) {
    if (filter !== 'day') return labels; // 🔥 selain day, balik normal

    return labels.map(h => String(h).padStart(2, '0') + ':00');
}

function renderChart(labels, data, filter = 'month') {
    const ctx = document.getElementById('chartThree').getContext('2d');

    if (chart) chart.destroy();

    // 🔥 format berdasarkan filter
    const finalLabels = formatHourLabels(labels, filter);

    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: finalLabels,
            datasets: [{
                label: 'Pengajuan',
                data: data,
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245,158,11,0.12)',
                borderWidth: 3,
                pointRadius: 5,
                pointBackgroundColor: '#f59e0b',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        },
        plugins: [{
            id: 'valueLabel',
            afterDatasetsDraw(chart) {
                const { ctx } = chart;

                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);

                    meta.data.forEach((point, index) => {
                        const value = dataset.data[index];

                        ctx.save();
                        ctx.fillStyle = '#f59e0b';
                        ctx.font = '11px sans-serif';
                        ctx.textAlign = 'center';
                        ctx.fillText(value, point.x, point.y - 10);
                        ctx.restore();
                    });
                });
            }
        }]
    });
}


// 🔥 LOAD AWAL (default month)
renderChart(@json($labels), @json($totals), 'month');


// 🔥 FILTER TANPA RELOAD
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        document.querySelectorAll('.filter-btn').forEach(b => {
            b.className = "filter-btn px-4 py-1.5 rounded-lg bg-gray-200 text-gray-700";
        });

        this.className = "filter-btn px-4 py-1.5 rounded-lg bg-amber-500 text-white";

        const filter = this.dataset.filter;

        fetch(`?filter=${filter}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(res => {
            renderChart(res.labels, res.totals, filter); // 🔥 kirim filter
        });
    });
});
</script>
