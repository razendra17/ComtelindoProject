@foreach ($packages as $pkg)

<div 
    class="package-card cursor-pointer border border-gray-800 rounded-[10px] p-3 flex justify-between items-center bg-white shadow-sm transition hover:shadow-md"
    data-package='@json($pkg)'
>
    <div>
        <p class="text-gray-500 text-sm font-medium mb-1">
            {{ $pkg->name }}
        </p>
        <h3 class="text-lg font-bold text-gray-900">
            {{ $pkg->speed }} Mbps
        </h3>
    </div>

    <div class="text-right">
        <span class="text-red-500 text-lg">
            Rp {{ number_format($pkg->price) }}
        </span>
    </div>
</div>

@endforeach