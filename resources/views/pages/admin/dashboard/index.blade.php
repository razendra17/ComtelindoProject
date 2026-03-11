@extends('layouts.app')

@section('content')
    <div class="mb-8 flex justify-center">
        <h1 class="text-3xl font-bold text-gray-800 tracking-wide">
            DASHBOARD
        </h1>
    </div>
    <div class="min-h-screen bg-gray-200/60 backdrop-blur-md flex justify-center p-6 rounded-3xl">

        <div class="w-full max-w-6xl">

            {{-- ROW 1 --}}
            <div class="mb-3 w-[100%]">
                {{-- Graph --}}
                <div class="col-span-2 bg-white rounded-2xl shadow-md p-6  ">
                    <h2 class="text-lg font-semibold mb-4">Total Pengajuan: {{ $alldata }} data</h2>
                    <canvas id="pengajuanChart"></canvas>
                </div>

            </div>

            {{-- ROW 2 --}}
            <div class="grid grid-cols-2 gap-6">

                {{-- Pengajuan --}}
                <div class="bg-white rounded-2xl shadow-md p-6">
                    <p class="text-gray-400 text-sm mb-4">Pengajuan</p>

                    <div class="grid grid-cols-2 gap-4">

                        {{-- Disetujui --}}
                        <div class="border-2 border-green-400 rounded-2xl p-4 shadow-sm">
                            <p class="text-green-500 text-sm mb-3">Disetujui</p>
                            <div class="bg-green-500 text-white text-center py-6 rounded-xl shadow-md">
                                <p class="text-lg font-semibold">{{ $approved }} data</p>
                            </div>
                        </div>

                        {{-- Menunggu --}}
                        <div class="border-2 border-amber-400 rounded-2xl p-4 shadow-sm">
                            <p class="text-amber-500 text-sm mb-3">Menunggu</p>
                            <div class="bg-amber-400 text-white text-center py-6 rounded-xl shadow-md">
                                <p class="text-lg font-semibold">{{ $pending }} data</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Pengajuan Ditolak --}}
                <div class="bg-white rounded-2xl shadow-md p-6">
                    <p class="text-gray-400 text-sm mb-4">Pengajuan di tolak</p>

                    <div class="flex gap-4">

                        {{-- Total Ditolak --}}
                        <div class="bg-red-500 text-white rounded-2xl flex items-center justify-center w-28 shadow-md">
                            <p class="text-lg font-semibold">{{ $rejected }} data</p>
                        </div>

                        {{-- Alasan Dominan --}}
                        <div class="space-y-2 w-full">
                            @forelse ($dominantReasons as $reason)
                                <div class="border border-red-300 rounded-lg p-2 text-xs text-red-400 text-center">
                                    {{ $reason->rejection }} ({{ $reason->total }})
                                </div>
                            @empty
                                <div class="text-xs text-gray-400 text-center">
                                    Belum ada data penolakan
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        const ctx = document.getElementById('pengajuanChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Pengajuan',
                    data: @json($totals),
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
