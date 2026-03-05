<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPackageRequest;
use App\Models\City;
use App\Models\Package;

class PackageController extends Controller
{
    public function indexPackage()
    {
        $cities = City::with('packages')->get();
        return view('pages.admin.add.package.index', compact('cities'));
    }
    public function storePackage(AddPackageRequest $request)
    {
        try {
            Package::create( $request->validated());

            return response()->json([
                'message' => 'Data berhasil dikirim!',
                'redirect' => route('package.index'),
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }
}
