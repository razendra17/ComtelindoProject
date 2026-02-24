<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // HALAMAN UTAMA
    public function index()
    {
        $cities = City::with('packages')->get();
        return view('pages.data.index', compact('cities'));
    }

    public function filter($cityId){
        $packages = Package::where('city_id', $cityId)->get();
        return response()->json($packages);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'number' => 'required|integer|max:11',
            'address' => 'required|max:100',
            'package_id' => 'required|exists:packages,id',
        ]);

        Data::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'package_id' => $request->package_id,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
