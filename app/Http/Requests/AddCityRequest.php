<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities')->where(function ($query){
                    return $query->where('area', $this->area);
                }),
            ],
            'area' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }
public function messages()
{
    return  [
        'name.required' => 'Nama kota wajib diisi',
        'name.unique' => 'Kota ini sudah ada!',
        'area.required' => 'Provinsi wajib diisi',
        'latitude.required' => 'Latitude wajib diisi',
        'latitude.numeric' => 'Latitude harus berupa angka',
        'latitude.between' => 'Latitude harus di antara -90 sampai 90',
        'longitude.required' => 'Longitude wajib diisi',
        'longitude.numeric' => 'Longitude harus berupa angka',
        'longitude.between' => 'Longitude harus di antara -180 sampai 180',
    ];
}
}
