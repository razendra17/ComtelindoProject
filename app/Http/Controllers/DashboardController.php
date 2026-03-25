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
            if ($filter === 'day') {
                $chartData = Data::selectRaw('HOUR(created_at) as label, COUNT(*) as total')
                    ->whereDate('created_at', now())
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
            } elseif ($filter === 'week') {
                $chartData = Data::selectRaw('DAYNAME(created_at) as label, COUNT(*) as total')
                    ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ->groupBy('label')
                    ->get();
            } else { // month
                $chartData = Data::selectRaw('DATE(created_at) as label, COUNT(*) as total')
                    ->whereMonth('created_at', now()->month)
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
            }

            $labels = $chartData->pluck('label');
            $totals = $chartData->pluck('total');

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
