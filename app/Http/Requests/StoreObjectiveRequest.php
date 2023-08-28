<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjectiveRequest extends FormRequest
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
            'ObjectiveTitle' => 'required|string|max:255',
            'Description' => 'required|string',
            'Category' => 'required|string',
            'ExpectedResult' => 'required|string',
            'Type' => 'required|in:improve,remove,number,logic,essential',
            'PlanningType' => 'required_if:Type,number,logic|string',
            'PlanningDays' => 'required_if:PlanningType,weekly,periodic|integer|min:1',
            'RestDays' => 'required_if:PlanningType,periodic|integer|min:0',
            'DureeEstimee' => 'required|string|in:one_week,two_weeks,one_month,two_months,three_months,six_months,one_year,custom',
            'CustomDuration' => 'required_if:DureeEstimee,custom|string',
            'Importance' => 'required|integer|min:1|max:5',
            'Planning' => 'required|string',
        ];
    }
}
