<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(){
        return view('pages.dashboard.index');
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
