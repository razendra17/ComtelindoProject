@extends('layouts.app')

@section('content')
    <!-- ===== Main Content Start ===== -->
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6 bg-[#ff6b09]">
          <div class="grid grid-cols-12 gap-4 md:gap-6">
            <div class="col-span-12 space-y-6 xl:col-span-7">
              <!-- Metric Group One -->
              @include('pages.admin.dashboard.partials.metric-group.metric-group-01')
              <!-- Metric Group One -->

              <!-- ====== Chart One Start -->
              @include('pages.admin.dashboard.partials.chart.chart-01')
              <!-- ====== Chart One End -->
            </div>
            <div class="col-span-12 xl:col-span-5">
              <!-- ====== Chart Two Start -->
              @include('pages.admin.dashboard.partials.chart.chart-02')
              <!-- ====== Chart Two End -->
            </div>
            
            <div class="col-span-12">
              <!-- ====== Chart Three Start -->
              @include('pages.admin.dashboard.partials.chart.chart-03')
              <!-- ====== Chart Three End -->
            </div>

            <div class="col-span-12">
              <!-- ====== Map One Start -->
              @include('pages.admin.dashboard.partials.map-01')
              <!-- ====== Map One End -->
            </div>
          </div>
        </div>
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->
@endsection
