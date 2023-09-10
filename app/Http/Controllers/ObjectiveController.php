<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObjectiveRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Objective;
use App\Models\Planning;
use App\Models\PlanningType;
use App\Models\TypeObjective;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ObjectiveController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $importanceLevels = [
            1 => __('Low'),
            2 => __('Moderate'),
            3 => __('Normal'),
            4 => __('High'),
            5 => __('Very High'),];

        $objectives = Objective::where('user_id', Auth::id())->get(); 
        // dd($objectives);
        return view('objective.index', compact('objectives','importanceLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $planningTypes = PlanningType::all();
        dump([
           "type of plans"=> $planningTypes,
        ]);

        return view('objective.create', compact('categories','planningTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObjectiveRequest $request)
    {
        // Get the validated data from the request
        $validatedData = $request->validated();


        $planningTypeId= $request->input('planning_type_id');
        // Create Planning record based on planning_type_id
        $planningData = [
           
            'planning_type_id' => $planningTypeId,
        ];
        // Retrieve the associated planning type based on the provided ID
        $planningType = PlanningType::find($planningTypeId);

        if ($planningType && $planningType->name === 'weekly or multiple times a week') {
            $planningData['selected_week_days'] = $request->input('selected_week_days');
        } elseif ($planningType && $planningType->name === 'periodic') {
            $planningData['number_of_days'] = $request->input('number_of_days');
            $planningData['number_of_rest_days'] = $request->input('number_of_rest_days');
        }
        
        $planning = Planning::create($planningData);
        
        // Now that you have the planning record, you can use its ID for the objective
        $objectiveData = array_merge($validatedData, ['planning_id' => $planning->id ,'user_id' => Auth::id()]);
        
        $objective = Objective::create($objectiveData);
        
        // dd([
        //     '$planningData'=>$planningData,
        //     "obj data" => $objectiveData
        // ]);
        // Redirect to a success page or return a response as needed
        return redirect()->route('objective.index')->with('success', 'Objective created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $objective = Objective::findOrFail($id); // Assuming 'Objective' is your model

        return view('objective.show', compact('objective'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Objective $objective)
    {
        try {
            // Toggle the 'is_done' status
            $objective->update(['is_done' => !$objective->is_done]);

            // Redirect back to the index page with a success message
            return response()->json(['message' => 'Status toggled successfully']);

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['message' => 'Failed to toggle objective status']);
        }
    }
}
