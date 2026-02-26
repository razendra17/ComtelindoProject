<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Package::all();
        $alldata = $data->count();
        $approved = Package::where('status', Constant::status['approved'])->count();
        $rejected = Package::where('status', Constant::status['rejected'])->count();
        $pending  = Package::where('status', Constant::status['pending'])->count();
        
        // return response()->json([
        //     $alldata,
        //     $approved,
        //     $rejected,
        //     $pending
        // ]);
        return view('pages.admin.dashboard.index', [
            'data' => $alldata,
            'approved' => $approved,
            'rejected' => $rejected,
            'pending' => $pending
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



    public function create() {}
    public function update() {}
    public function destroy() {}
}
