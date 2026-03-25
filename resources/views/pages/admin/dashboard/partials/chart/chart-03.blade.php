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
        <div id="chartThree" height="100"></div>
    </div>

</div>
<script>
    document.querySelectorAll(".filter-btn").forEach(btn => {

        btn.addEventListener("click", function() {

            document.querySelectorAll(".filter-btn").forEach(b => {
                b.classList.remove("bg-amber-500", "text-white");
                b.classList.add("bg-gray-200", "text-gray-700");
            });

            this.classList.remove("bg-gray-200", "text-gray-700");
            this.classList.add("bg-amber-500", "text-white");

            const filter = this.dataset.filter;

            fetch(`{{ route('dashboard.stat') }}?filter=${filter}`)
                .then(res => res.json())
                .then(res => {
                    window.chart.updateOptions({
                        xaxis: {
                            categories: res.labels
                        },
                        series: [{
                            name: "Pengajuan",
                            data: res.totals
                        }]
                    });
                });

        });

    });
</script>
