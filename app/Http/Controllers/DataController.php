<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Data;
use App\Models\Packages;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index() {
        return view('pages.data.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->q;

        $cities = City::where('name', 'LIKE', "%{$keyword}%")
            ->limit(5)
            ->get();

        return response()->json($cities);
    }
    public function create(Request $request) {}
}
