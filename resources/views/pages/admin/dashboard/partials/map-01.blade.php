<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">

    <!-- HEADER -->
    <div class="flex justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Customers Demographic
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Data jumlah customer berdasar Daerah
            </p>
        </div>
    </div>

    <!-- MAP -->
    <div class="my-6 rounded-2xl border bg-gray-50 p-4">
        <div id="mapOne" class="h-[50vh] w-full rounded-xl"></div>
    </div>

    <!-- LIST -->
    <div class="space-y-5">
        @foreach ($cityStats as $city => $item)
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-semibold text-gray-800">
                        {{ $city }}
                    </p>
                    <span class="text-xs text-gray-500">
                        {{ $item['total'] }} Customers
                    </span>
                </div>

                <div class="flex w-full max-w-[140px] items-center gap-3">
                    <div class="relative h-2 w-full rounded bg-gray-200">
                        <div class="absolute left-0 top-0 h-full rounded bg-amber-500"
                            style="width: {{ $item['percentage'] }}%"></div>
                    </div>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $item['percentage'] }}%
                    </p>
                </div>

            </div>
        @endforeach
    </div>
</div>

<script>
    (function() {

        function initMap() {

            const el = document.getElementById('mapOne');
            if (!el || typeof L === 'undefined') return;

            //  HAPUS MAP LAMA (anti double render)
            if (window.mapInstance) {
                window.mapInstance.remove();
            }

            // =========================
            // 🗺️ INIT MAP
            // =========================
            const map = L.map('mapOne', {
                zoomControl: false
            }).setView([-2.5, 118], 5);

            window.mapInstance = map;

            // =========================
            // 🇮🇩 BATAS INDONESIA
            // =========================
            const bounds = [
                [-11.0, 94.0],
                [6.5, 141.0]
            ];

            map.setMaxBounds(bounds);

            // =========================
            // TILE
            // =========================
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            //  FIX MAP BLANK
            setTimeout(() => {
                map.invalidateSize();
            }, 200);

            // =========================
            //  MARKER DARI DB
            // =========================
            const users = @json($data);

            users.forEach(item => {
                if (!item.package || !item.package.city) return;

                const city = item.package.city;
                const data = item;

                if (city.latitude && city.longitude) {
                    const marker = L.circleMarker([city.latitude, city.longitude], {
                            radius: 6,
                            color: '#f59e0b',
                            fillColor: '#f59e0b',
                            fillOpacity: 0.7
                        })
                        .addTo(map)
                    marker.bindPopup(`<b>${city.name}</b><br>${data.name}`);

                    marker.on('mouseover', function() {
                        this.openPopup();
                    });

                    marker.on('mouseout', function() {
                        this.closePopup();
                    });

                    marker.on('click', function(){
                      window.location.href = `http://127.0.0.1:8000/admin/data/details/${data.package.name}-${data.id}`;
                    })
                }
            });

        }

        // =========================
        //  INIT AMAN
        // =========================
        window.addEventListener('load', () => {
            setTimeout(initMap, 200);
        });

    })();
</script>
