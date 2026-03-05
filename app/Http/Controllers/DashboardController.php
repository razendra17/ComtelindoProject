<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{



    // dashboard index page
    public function index(Request $request)
    {
        try {
            //filter waktu
            $start = $request->start_date
                ? Carbon::parse($request->start_date)->startOfDay()
                : Carbon::now()->subDays(7)->startOfDay();

            $end = $request->end_date
                ? Carbon::parse($request->end_date)->endOfDay()
                : Carbon::now()->endOfDay();

            $statusCounts = Data::select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

            $alldata  = $statusCounts->sum();
            $approved = $statusCounts[Constant::status['approved']] ?? 0;
            $rejected = $statusCounts[Constant::status['rejected']] ?? 0;
            $pending  = $statusCounts[Constant::status['pending']] ?? 0;

            $chartData = Data::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            $labels = $chartData->pluck('tanggal');
            $totals = $chartData->pluck('total');

            $dominantReasons = Data::where('status', Constant::status['rejected'])
                ->select('rejection', DB::raw('COUNT(*) as total'))
                ->groupBy('rejection')
                ->orderByDesc('total')
                ->limit(3)
                ->get();

            return view('pages.admin.dashboard.index', compact(
                'alldata',
                'approved',
                'rejected',
                'pending',
                'labels',
                'totals',
                'dominantReasons'
            ));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }
}
