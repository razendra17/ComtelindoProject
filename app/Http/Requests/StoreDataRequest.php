<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'number' => 'required|digits_between:9,13',
            'address' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'package_id' => 'required|exists:packages,id',
            'address_detail' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'number.required' => 'Nomor HP wajib diisi',
            'number.digits_between' => 'Format nomor HP tidak valid',
            'address.required' => 'Alamat wajib ada',
        ];
    }
}
