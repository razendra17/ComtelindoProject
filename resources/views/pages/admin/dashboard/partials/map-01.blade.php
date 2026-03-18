<div
  class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6"
>
  <div class="flex justify-between">
    <div>
      <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
        Customers Demographic
      </h3>
      <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
        Number of customer based on country
      </p>
    </div>

    <div x-data="{openDropDown: false}" class="relative h-fit">
      
      <div
        x-show="openDropDown"
        @click.outside="openDropDown = false"
        class="absolute right-0 top-full z-40 w-40 space-y-1 rounded-2xl border border-gray-200 bg-white p-2 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark"
      >
        <button
          class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
        >
          View More
        </button>
        <button
          class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
        >
          Delete
        </button>
      </div>
    </div>
  </div>
  <div
    class="border-gary-200 my-6 overflow-hidden rounded-2xl border bg-gray-50 px-4 py-6 dark:border-gray-800 dark:bg-gray-900 sm:px-6"
  >
    <div
      id="mapOne"
      class="mapOne map-btn -mx-4 -my-6 h-[212px] w-[252px] 2xsm:w-[307px] xsm:w-[358px] sm:-mx-6 md:w-[668px] lg:w-[634px] xl:w-[393px] 2xl:w-[554px]"
    ></div>
  </div>

  <div class="space-y-5">
    @foreach($cityStats as $city => $item)
      <div class="flex items-center justify-between">
        
        <!-- kiri -->
        <div class="flex items-center gap-3">
          <div>
            <p class="text-theme-sm font-semibold text-gray-800 dark:text-white/90">
              {{ $city }}
            </p>
            <span class="block text-theme-xs text-gray-500 dark:text-gray-400">
              {{ $item['total'] }} Customers
            </span>
          </div>
        </div>
  
        <!-- kanan -->
        <div class="flex w-full max-w-[140px] items-center gap-3">
          <div class="relative block h-2 w-full max-w-[100px] rounded-sm bg-gray-200 dark:bg-gray-800">
            <div
              class="absolute left-0 top-0 h-full rounded-sm bg-brand-500"
              style="width: {{ $item['percentage'] }}%"
            ></div>
          </div>
          <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">
            {{ $item['percentage'] }}%
          </p>
        </div>
  
      </div>
    @endforeach
  </div>
</div>

<script>
const users = @json($data);
</script>
