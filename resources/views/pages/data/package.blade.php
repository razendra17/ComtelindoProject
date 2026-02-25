@foreach ($packages as $pkg)
    <div class="package-card 
           w-full
           cursor-pointer 
           border border-gray-200 
           rounded-xl 
           p-4 
           flex flex-col sm:flex-row 
           sm:justify-between 
           sm:items-center 
           gap-3
           bg-white 
           shadow-sm 
           transition 
           hover:shadow-lg 
           hover:-translate-y-1
           duration-300"
        data-package='@json($pkg)'>

        <!-- Kiri -->
        <div>
            <p class="text-gray-500 text-sm font-medium mb-1">
                {{ $pkg->name }}
            </p>

            <h3 class="text-xl font-bold text-gray-900">
                {{ $pkg->speed }} Mbps
            </h3>
        </div>

        <!-- Kanan -->
        <div class="sm:text-right">
            <span class="text-red-500 text-lg sm:text-xl ">
                Rp {{ number_format($pkg->price) }}
            </span>
        </div>

    </div>
@endforeach
