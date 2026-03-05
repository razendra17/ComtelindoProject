<?php

namespace App\Http\Requests;

use App\Constant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RejectDataRequest extends FormRequest
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
            'reason' => [
                'required',
                Rule::in(array_values(Constant::rejectionMessage))
            ]
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'Alasan wajib diisi',
            'reason.in' => 'Alasan tidak valid'
        ];
    }
}
