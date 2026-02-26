<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Data $data)
    {
        $data = Data::all();
        $alldata = $data->count();

        $approved = Data::where('status', Constant::status['approved'])->count();
        $rejected = Data::where('status', Constant::status['rejected'])->count();
        $pending  = Data::where('status', Constant::status['pending'])->count();


        // return response()->json([
        //     $alldata,
        //     $approved,
        //     $rejected,
        //     $pending
        // ]);

        $start = $request->start_date ?? Carbon::now()->subDays(7);
        $end   = $request->end_date ?? Carbon::now();

        $data = DB::table('data')
            ->select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = $data->pluck('tanggal');
        $totals = $data->pluck('total');

        // Ambil alasan paling sering muncul
        $dominantReasons = DB::table('data')
            ->where('data.status', 'rejected')
            ->select('data.rejection', DB::raw('COUNT(*) as total'))
            ->groupBy('data.rejection')
            ->orderByDesc('total')
            ->take(3) // ambil 3 teratas
            ->get();


        return view('pages.admin.dashboard.index', [
            'data' => $alldata,
            'approved' => $approved,
            'rejected' => $rejected,
            'pending' => $pending,
            'labels' => $labels,
            'totals' => $totals,
            'dominantReasons' => $dominantReasons,

        ]);
    }
    public function data()
    {

        $query = Data::with('package.city');
        return DataTables::of($query)
            ->addColumn('package_name', function ($row) {
                return $row->package?->name;
            })
            ->addColumn('city_name', function ($row) {
                return $row->package?->city?->name;
            })
            ->make(true);
    }


    public function indexCity()
    {
        return view('pages.admin.add.city.index');
    }

    public function indexPackage()
    {
        $cities = City::with('packages')->get();
        return view('pages.admin.add.package.index', compact('cities'));
    }

}


