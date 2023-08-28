<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'health_fitness' => 'required|numeric|min:0|max:10',
            'relationships' => 'required|numeric|min:0|max:10',
            'spirituality' => 'required|numeric|min:0|max:10',
            'environment' => 'required|numeric|min:0|max:10', // Corrected field name
            'free_time' => 'required|numeric|min:0|max:10',
            'work_business' => 'required|numeric|min:0|max:10',
            'feelings' => 'required|numeric|min:0|max:10',
            'money_finance' => 'required|numeric|min:0|max:10',
        ];
    }
}
