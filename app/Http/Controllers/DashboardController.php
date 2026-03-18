<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\DashboardDataRequest;
use App\Models\Data;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // dashboard index page
    public function index(DashboardDataRequest $request)
    {
        try {
            //filter waktu
            $start = $request->startDate();
            $end = $request->endDate();

            $statusCounts = Data::statusSummary();

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

            $alldata  = $statusCounts->sum();
            $approved = $statusCounts[Constant::status['approved']] ?? 0;
            $rejected = $statusCounts[Constant::status['rejected']] ?? 0;
            $pending  = $statusCounts[Constant::status['pending']] ?? 0;
            $data = Data::with('package.city')->get();

            $chartData = Data::dashboardData($start, $end);

            $labels = $chartData->pluck('nama_bulan');
            $totals = $chartData->pluck('total');

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
                'dominantReasons'
            ));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }
}
