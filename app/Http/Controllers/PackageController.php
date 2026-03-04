<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function indexPackage()
    {
        $cities = City::with('packages')->get();
        return view('pages.admin.add.package.index', compact('cities'));
    }
    public function storePackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'price' => 'required|int|max:999999|min:50000',
            'speed' => 'required|int|max:9999',
            'device' => 'required|int|max:99',
            'city_id' => 'required|int|exists:cities,id',
        ], [
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
