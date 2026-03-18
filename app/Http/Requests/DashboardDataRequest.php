<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class DashboardDataRequest extends FormRequest
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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ];
    }

    public function startDate()
{
    return $this->start_date
        ? Carbon::parse($this->start_date)->startOfDay()
        : Carbon::now()->startOfYear(); // 👈 FIX
}

public function endDate()
{
    return $this->end_date
        ? Carbon::parse($this->end_date)->endOfDay()
        : Carbon::now()->endOfYear(); // 👈 FIX
}
}
