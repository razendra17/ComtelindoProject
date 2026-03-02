<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
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
    }

    public function dataIndex()
    {
        return view('pages.admin.data.index', [
            'rejectionMessages' => Constant::rejectionMessage
        ]);
    }

    public function data()
    {
        $data = Data::with('package.city');

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                return '<span class="font-semibold text-gray-700">' . $row->status . '</span>';
            })
            ->addColumn('action', function ($row) {

                return view('pages.admin.data.button.action', compact('row'))->render();
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function approve($id)
    {
        $data = Data::findOrFail($id);
        $data->status = Constant::status['approved']; // atau 'approved'
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Package approved successfully'
        ]);
    }

    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => [
                'required',
                Rule::in(array_values(Constant::rejectionMessage))
            ]
        ]);

        $data = Data::findOrFail($id);
        $data->status = Constant::status['rejected'];
        $data->rejection = $validated['reason'];
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Rejection success'
        ]);
    }

    public function details($slug)
    {
        $id = explode('-', $slug);
        $id = end($id);

        $data = Data::with('package.city')->findOrFail($id);
        $package = $data->package;
        $city = $package->city;

        return view('pages.admin.data.details.index', compact('slug', 'data', 'package', 'city'));
    }
}
