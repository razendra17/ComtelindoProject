<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatatablesRequest extends FormRequest
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

    public function getFilter($data){
        if ($this->status) {
            $data->where('status', $this->status);
        }

        // FILTER CITY
        if ($this->city_id) {
            $data->whereHas('package.city', function ($q){
                $q->where('id', $this->city_id);
            });
        }

        // FILTER PACKAGE
        if ($this->package_id) {
            $data->where('package_id', $this->package_id);
        }

        return $data;
    }
    public function rules(): array
    {
        return [
        ];
    }
}
