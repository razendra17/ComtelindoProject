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


    public function area(Package $package, $slug)
    {
        $id = explode('-', $slug);
        $id = end($id);

        $package = Package::with('city')->findOrFail($id);
        $city = $package->city;
        // return response()->json([$city->latitude]);
        return view('pages.data.modal.area', [
            'package' => $package,
            'city' => $city->name,
            'lat' => $city->latitude,
            'long' => $city->longitude,
            'slug' => $slug
        ]);
    }

    public function filter($cityId)
    {
        $packages = Package::where('city_id', $cityId)->get();
        return view('pages.data.package', compact('packages'))->render();
    }


    public function storeAddress(Request $request, $slug)
    {
        $id = explode('-', $slug);
        $id = end($id);

        session([
            'temp.package_id' => $id,
            'temp.address' => $request->address,
        ]);

        return redirect()->route('personal.index', ['slug' => $slug]);
    }

    public function personal($slug)
    {
        $id = explode('-', $slug);
        $id = end($id);

        $package = Package::findOrFail($id);

        $address = session('temp.address');

        return view('pages.data.personal.index', [
            'package' => $package,
            'address' => $address
        ]);
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
