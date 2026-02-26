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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    public function storeCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities')->where(function ($query) use ($request) {
                    return $query->where('area', $request->area);
                }),
            ],
            'area' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ], [
            'name.required' => 'Nama kota wajib diisi',
            'area.required' => 'Provinsi wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'latitude.numeric' => 'Latitude harus berupa angka',
            'latitude.between' => 'Latitude harus di antara -90 sampai 90',
            'longitude.required' => 'Longitude wajib diisi',
            'longitude.numeric' => 'Longitude harus berupa angka',
            'longitude.between' => 'Longitude harus di antara -180 sampai 180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        City::create($validator->validated());

        return response()->json([
            'message' => 'City berhasil dikirim!',
            'redirect' => route('city.index') // halaman awal
        ], 200);
    }
}
