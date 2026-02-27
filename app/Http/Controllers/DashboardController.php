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
    public function storePackage(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:225',
        'price' => 'required|int|max:99999999|min:50000',
        'speed' => 'required|int|max:9999',
        'device' => 'required|int|max:99',
        'city_id' => 'required|int|exists:cities,id',
      ],[
        'name.required' => 'Nama paket wajib diisi!',
        'price.required' => 'Harga paket wajib diisi!',
        'speed.required' => 'Kecepatan paket wajib diisi!',
        'device.required' => 'Jumlah optimal deivce wajib diisi!',
        'city_id.required' => 'Kota paket wajib diisi!',

        'name.string' => 'Masukan nama yang benar!',
        'price.integer' => 'Masukan harga yang benar!',
        'speed.integer' => 'Masukan kecepatan yang benar!',
        'device.integer' => 'Masukan divice yang benar!',
        'city_id.integer' => 'Masukan kota yang benar!',    

        'name.max' => 'Masukan nama yang benar!',
        'price.max' => 'Maximal harga telah di capai!',
        'price.min' => 'Maximal harga adalah Rp50.000!',
        '*.max' => 'Masukan angka yang benar!',
    ]);

      if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    Package::create($validator->validated());

    return response()->json([
        'message' => 'Data berhasil dikirim!',
        'redirect' => route('package.index'),
    ], 200);
    }

}


