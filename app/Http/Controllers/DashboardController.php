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

            $alldata  = $statusCounts->sum();
            $approved = $statusCounts[Constant::status['approved']] ?? 0;
            $rejected = $statusCounts[Constant::status['rejected']] ?? 0;
            $pending  = $statusCounts[Constant::status['pending']] ?? 0;

            $chartData = Data::dashboardData($start, $end);

            $labels = $chartData->pluck('tanggal');
            $totals = $chartData->pluck('total');

            $dominantReasons = Data::dominantReason();

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
