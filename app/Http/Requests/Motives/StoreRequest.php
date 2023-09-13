<?php

namespace App\Http\Requests\Motives;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'objective_id' => 'required|exists:objectives,id',
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'string',
        ];
    }
}
