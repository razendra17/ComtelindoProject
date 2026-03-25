<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\DashboardDataRequest;
use App\Models\Data;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DashboardDataRequest $request)
    {
        try {

            // ===============================
            //  FILTER (default = month)
            // ===============================
            $filter = request('filter', 'month');

            $start = $request->startDate();
            $end = $request->endDate();

            // ===============================
            //  STATUS SUMMARY
            // ===============================
            $statusCounts = Data::statusSummary();

            $alldata  = $statusCounts->sum();
            $approved = $statusCounts[Constant::status['approved']] ?? 0;
            $rejected = $statusCounts[Constant::status['rejected']] ?? 0;
            $pending  = $statusCounts[Constant::status['pending']] ?? 0;

            // ===============================
            //  CITY STATS
            // ===============================
            $cityStats = Data::with('package.city')
                ->get()
                ->groupBy(function ($item) {
                    return $item->package->city->name ?? 'Tidak diketahui';
                })
                ->map(function ($items) {
                    return $items->count();
                })
                ->sortDesc();

            $totalUsers = $cityStats->sum();

            $cityStats = $cityStats->map(function ($count) use ($totalUsers) {
                return [
                    'total' => $count,
                    'percentage' => $totalUsers > 0 ? round(($count / $totalUsers) * 100) : 0
                ];
            });

            // ===============================
            //  CHART DATA (DINAMIS)
            // ===============================
            $filter = request('filter', 'month');

            if ($filter === 'day') {

                $chartData = Data::selectRaw('HOUR(created_at) as label, COUNT(*) as total')
                    ->whereDate('created_at', now())
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();

                $labels = collect(range(0, 23));
                $totals = array_fill(0, 24, 0);

                foreach ($chartData as $item) {
                    $totals[$item->label] = $item->total;
                }
            } elseif ($filter === 'week') {

                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

                $chartData = Data::selectRaw('DAYOFWEEK(created_at) as label, COUNT(*) as total')
                    ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ->groupBy('label')
                    ->get();

                $labels = $days;
                $totals = array_fill(0, 7, 0);

                foreach ($chartData as $item) {
                    $index = $item->label - 2;
                    if ($index < 0) $index = 6;
                    $totals[$index] = $item->total;
                }
            } else { // month

                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                $chartData = Data::selectRaw('MONTH(created_at) as label, COUNT(*) as total')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();

                $labels = $months;
                $totals = array_fill(0, 12, 0);

                foreach ($chartData as $item) {
                    $totals[$item->label - 1] = $item->total;
                }
            }

            // ===============================
            //  AJAX RESPONSE
            // ===============================
            if (request()->ajax()) {
                return response()->json([
                    'labels' => $labels,
                    'totals' => $totals
                ]);
            }

            // ===============================
            //  REQUEST TARGET 
            // ===============================
            $target = 15;

            $current = Data::whereMonth('created_at', now()->month)->count();

            $lastMonth = Data::whereMonth('created_at', now()->subMonth()->month)->count();

            $percentageChange = $lastMonth > 0
                ? round((($current - $lastMonth) / $lastMonth) * 100)
                : 0;

            $remaining = max($target - $current, 0);

            // ===============================
            //  DATA LAIN
            // ===============================
            $data = Data::with('package.city')->get();
            $dominantReasons = Data::dominantReason();

            return view('pages.admin.dashboard.index', compact(
                'data',
                'cityStats',
                'alldata',
                'approved',
                'rejected',
                'pending',
                'labels',
                'totals',
                'filter',
                'dominantReasons',
                'filter',
                'target',
                'current',
                'remaining',
                'percentageChange'
            ));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }
}
