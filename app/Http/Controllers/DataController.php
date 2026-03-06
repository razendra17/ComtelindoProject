<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\RejectDataRequest;
use App\Http\Requests\StoreDataRequest;
use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use App\Services\StatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    // Main page, use for user temp package
    public function userIndex()
    {
        $cities = City::with('packages')->get();
        $user = auth()->user();
        return view('pages.user.index', compact('cities'));

    }

    // temp user area, get from selected user package
    public function area(Package $package, $slug)
    {
        try {
            $id = explode('-', $slug);
            $id = end($id);

            $package = Package::with('city')->findOrFail($id);
            $city = $package->city;
            return view('pages.user.area.index', [
                'package' => $package,
                'city' => $city->name,
                'lat' => $city->latitude,
                'long' => $city->longitude,
                'slug' => $slug
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // filter package by city
    public function filter($cityId)
    {
        $packages = Package::where('city_id', $cityId)->get();
        return view('pages.user.assets.Package', compact('packages'))->render();
        
    }

    // temp user store adress
    public function storeAddress(Request $request, $slug)
    {
        try {
            $id = explode('-', $slug);
            $id = end($id);

            session([
                'temp.package_id' => $id,
                'temp.address' => $request->address,
                'temp.latitude' => $request->latitude,
                'temp.longitude' => $request->longitude,
            ]);

            return redirect()->route('personal.index', compact('slug'));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // Personal user forms
    public function personalForms($slug)
    {
        try {
            $id = explode('-', $slug);
            $id = end($id);

            $package = Package::findOrFail($id);

            $address = session('temp.address');
            $latitude = session('temp.latitude');
            $longitude = session('temp.longitude');

            return view('pages.user.personal.index', compact('latitude', 'longitude', 'package', 'address', 'id', 'slug'));
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    // store user data
    public function dataStore(StoreDataRequest $request)
    {
        try {
            Data::create($request->validated());

            return response()->json([
                'message' => 'Data berhasil dikirim!',
                'redirect' => route('redirect.index') // halaman awal
            ], 200);

        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    public function redirect()
    {
        return view('pages.user.redirect');

    }
}
