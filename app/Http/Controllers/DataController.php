<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    // HALAMAN UTAMA
    public function index()
    {
        $cities = City::with('packages')->get();
        $user = auth()->user();
        return view('pages.data.index', compact('cities'));
    }


    public function area(Package $package, $slug)
    {
        $id = explode('-', $slug);
        $id = end($id);

        $package = Package::with('city')->findOrFail($id);
        $city = $package->city;
        // return response()->json([$city->latitude]);
        return view('pages.data.area.index', [
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
        return view('pages.data.assets.Package', compact('packages'))->render();
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
            'address' => $address,
            'slug' => $slug
        ]);
    }

    public function packageStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'number' => ['required', 'regex:/^(\+62|62|0)[0-9]{9,13}$/'],
            'address' => 'required|string',
            'package_id' => 'required|exists:packages,id',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'number.required' => 'Nomor HP wajib diisi',
            'number.regex' => 'Format nomor HP tidak valid',
            'address.required' => 'Alamat wajib ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Data::create($validator->validated());

        return response()->json([
            'message' => 'Data berhasil dikirim!',
            'redirect' => route('data.index') // halaman awal
        ], 200);
    }
}
