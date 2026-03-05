<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPackageRequest extends FormRequest
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
            'name' => 'required|string|max:225',
            'price' => 'required|int|max:99999999|min:50000',
            'speed' => 'required|int|max:9999',
            'device' => 'required|int|max:99',
            'city_id' => 'required|int|exists:cities,id',
        ];
    }

    public function messages()
    {
        return [
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
            '*.max' => 'Masukan angka yang benar!',
        ];
    }
}
