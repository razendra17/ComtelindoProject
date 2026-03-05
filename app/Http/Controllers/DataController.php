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
        return view('pages.user.index', compact('cities'));
    }


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

    public function filter($cityId)
    {
        $packages = Package::where('city_id', $cityId)->get();
        return view('pages.user.assets.Package', compact('packages'))->render();
    }


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

            return redirect()->route('personal.index', ['slug' => $slug]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    public function personal($slug)
    {
        try {

            $id = explode('-', $slug);
            $id = end($id);

            $package = Package::findOrFail($id);

            $address = session('temp.address');
            $latitude = session('temp.latitude');
            $longitude = session('temp.longitude');

            return view('pages.user.personal.index', [
                'package' => $package,
                'address' => $address,
                'slug' => $slug,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }

    public function packageStore(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'number' => ['required', 'regex:/^(\+62|62|0)[0-9]{9,13}$/'],
                'address' => 'required|string',
                'latitude' => 'required',
                'longitude' => 'required',
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
