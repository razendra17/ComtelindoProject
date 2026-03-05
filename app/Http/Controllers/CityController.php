<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function indexCity()
    {
        return view('pages.admin.add.city.index');
    }

    public function storeCity(AddCityRequest $request)
    {
        try {
            City::create($request->validated());

            return response()->json([
                'message' => 'City berhasil dikirim!',
                'redirect' => route('city.index') // halaman awal
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e, 'internal server error', 500);
        }
    }
}
