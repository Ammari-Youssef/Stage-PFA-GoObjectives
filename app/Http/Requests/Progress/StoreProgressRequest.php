<?php

namespace App\Http\Requests\Progress;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreProgressRequest extends FormRequest
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
        $categories = Category::pluck('id')->toArray();
        $rules = [];

        foreach ($categories as $categoryID) {
            $rules["category_$categoryID"] = "required|numeric|min:0|max:10";
        }

        return $rules;
    }
}
