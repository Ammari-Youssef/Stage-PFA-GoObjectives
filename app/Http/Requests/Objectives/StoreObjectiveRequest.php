<?php

namespace App\Http\Requests\Objectives;

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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'desired_result' => 'required|in:1,0',
            'type' => 'required|in:number,time,behavioral,essential',
            'number_value' => 'required_if:type,number|min:0',
            'behavior_option' => 'required_if:type,behavioral|in:1,0',
            'initial_time' => 'required_if:type,time',
            'target_time' => 'required_if:type,time',
            'importance' => 'required|integer|between:1,5',
            'start_date' => 'required|date',
            'estimated_duration' => 'required|in:1_week,2_weeks,1_month,2_months,3_months,6_months,1_year',
            'end_date' => 'required|date',
            'planning_type_id' => 'required|integer|exists:planning_types,id', //verifier plannings_id exist dans la table planning_type sous colonne id
            'selected_week_days' => 'required_if:planning_type_id,2|array',
            'number_of_days' => 'required_if:planning_type_id,3',
            'number_of_rest_days' => 'required_if:planning_type_id,3|min:0',

        ];
    }
}
