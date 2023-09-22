<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Objective $objective)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('result.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define the validation rules based on the objective type
        $rules = [
            'result_date' => 'required|date',
            'comment' => 'nullable|string|max:250',
            'objective_id' => 'required|exists:objectives,id',
        ];

        if ($request->input('objective_type') === 'number') {
            $rules['number_value'] = 'required|numeric';
        } elseif ($request->input('objective_type') === 'time') {
            $rules['experience_time_value'] = 'required|date_format:H:i';
        } elseif ($request->input('objective_type') === 'behavioral') {
            $rules['behavior_result'] = 'required|in:1,0';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Use the validated data to create a new result
        $result = Result::create([
            'result_date' => $validatedData['result_date'],
            'comment' => $validatedData['comment'],
            'objective_id' => $validatedData['objective_id'],
            // Add other fields based on the objective type
            'number_value' => $validatedData['number_value'] ?? null,
            'experience_time_value' => $validatedData['experience_time_value'] ?? null,
            'behavior_result' => $validatedData['behavior_result'] ?? null,
        ]);


        return response()->json(['success' => true, 'result' => $result,]); //
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        return response()->json(['result'=>$result , 'objectiveType'=>$result->objective->type]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        // Define the validation rules based on the objective type
        $rules = [
            'result_date' => 'required|date',
            'comment' => 'nullable|string|max:250',
            'objective_id' => 'required|exists:objectives,id',
        ];

        if ($request->input('objective_type') === 'number') {
            $rules['number_value'] = 'required|numeric';
        } elseif ($request->input('objective_type') === 'time') {
            $rules['experience_time_value'] = 'required|date_format:H:i';
        } elseif ($request->input('objective_type') === 'behavioral') {
            $rules['behavior_result'] = 'required|in:1,0';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Update the attributes of the existing result
        $result->update([
            'result_date' => $validatedData['result_date'],
            'comment' => $validatedData['comment'],
            'objective_id' => $validatedData['objective_id'],
            // Add other fields based on the objective type
            'number_value' => $validatedData['number_value'] ?? null,
            'experience_time_value' => $validatedData['experience_time_value'] ?? null,
            'behavior_result' => $validatedData['behavior_result'] ?? null,
        ]);

        return response()->json(['success' => true, 'result' => $result, 'message' => 'Result updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $result->delete();
        return response()->json(['message' => 'Result deleted successfully', 'result_id' => $result->id]);
    }
}
