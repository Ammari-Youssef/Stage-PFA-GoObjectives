<?php

namespace App\Http\Controllers;

use App\Http\Requests\Objectives\StoreObjectiveRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Objective;
use App\Models\Planning;
use App\Models\PlanningType;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

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
            5 => __('Very High'),
        ];

        $objectives = Objective::where('user_id', Auth::id())->get();
        // dd($objectives);
        return view('objective.index', compact('objectives', 'importanceLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Objective $objective,Request $request)
{
    $objective_parent_id = $request->input('objective_parent_id'); 
       
        $categories = Category::all();
        $planningTypes = PlanningType::all();
        dump([
            "type of plans" => $planningTypes,
            "parent id " => $objective_parent_id,
        ]);

        return view('objective.create', compact('objective','objective_parent_id','categories', 'planningTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObjectiveRequest $request)
    {
        // Get the validated data from the request
        $validatedData = $request->validated();


        $planningTypeId = $request->input('planning_type_id');
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
        $objectiveData = array_merge($validatedData, ['planning_id' => $planning->id, 'user_id' => Auth::id()]);

        $mainObjective = Objective::create($objectiveData);
        $parentObjectiveId = $request->input('objective_parent_id');

        if ($parentObjectiveId) {
            $parentObjective = Objective::findOrFail($parentObjectiveId);
            $mainObjective->parentObjective()->associate($parentObjective);
            $mainObjective->save();
        }

        // dd([
        //     '$planningData'=>$planningData,
        //     "obj data" => $objectiveData,
        //     $validatedData
        // ]);
        // Redirect to a success page or return a response as needed
        return redirect()->route('objective.index')->with('success', 'Objective created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Objective $objective)
    {
        // Load the subobjectives related to the main objective
        $subobjectives = Objective::where('objective_parent_id', $objective->id)->get();

        $targetTime = $objective->target_time;
        $hours = date('H', strtotime($targetTime));
        $minutes = date('i', strtotime($targetTime));
        $seconds = date('s',strtotime($targetTime) );
        if ($hours > 0) {
            $formattedTime = $hours . ' ' . __('hour');
            if ($hours > 1) {
                $formattedTime .= 's';
            }

            if ($minutes > 0) {
                $formattedTime .= ' ' . $minutes . ' ' . __('minute');
                if ($minutes > 1) {
                    $formattedTime .= 's';
                }
            }
            if ($seconds > 0) {
                if ($formattedTime !== '') {
                    $formattedTime .= ' ';
                }
                $formattedTime .= $seconds . ' ' . __('second');
                if ($seconds > 1) {
                    $formattedTime .= 's';
                }
            }
        } elseif ($minutes > 0) {
            $formattedTime = $minutes . ' ' . __('minute');
            if ($minutes > 1) {
                $formattedTime .= 's';
            }
        } else {
            $formattedTime = __('No time specified');
        }



        // dump([
        //     'objective' => $objective,
        //     'sub goals' => $subobjectives,
        // ]);
        return view('objective.show', compact('objective', 'subobjectives','formattedTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Objective $objective, Request $request)
    {
        $objective_parent_id = $request->input('objective_parent_id');

        $categories = Category::all();
        $planningTypes = PlanningType::all();
        dump([
            "type of plans" => $planningTypes,
            "parent id " => $objective_parent_id,
        ]);

        return view('objective.edit', compact('objective', 'objective_parent_id', 'categories', 'planningTypes'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreObjectiveRequest $request, $id)
    {
        // Get the validated data from the request
        $validatedData = $request->validated();

        $objective = Objective::findOrFail($id);

        // Update the existing objective with the new data
        $objective->update($validatedData);

        // Update related planning data based on planning_type_id (similar to the store method)
        $planningTypeId = $request->input('planning_type_id');

        // Retrieve the associated planning record based on the provided ID
        $planning = Planning::where('id', $objective->planning_id)->first();

        if ($planning) {
            // Update the planning data based on $planningTypeId
            $planningData = ['planning_type_id' => $planningTypeId];
            $planningType = PlanningType::find($planningTypeId);
            
            if ($planningType && $planningType->name === 'weekly or multiple times a week') {
                $planningData['selected_week_days'] = $request->input('selected_week_days');
            } elseif ($planningType && $planningType->name === 'periodic') {
                $planningData['number_of_days'] = $request->input('number_of_days');
                $planningData['number_of_rest_days'] = $request->input('number_of_rest_days');
            }

            $planning->update($planningData);
        }


        // Redirect to a success page or return a response as needed
        return redirect()->route('objective.index')->with('success', 'Objective updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Objective $objective)
    {
        // Delete the objective
        $objective->delete();

        return redirect()->route('objective.index')->with('success', 'Objective deleted successfully.');

    }

    public function toggleStatus(Objective $objective)
    {
        try {
            // Toggle the 'is_done' status
            $objective->update(['is_done' => !$objective->is_done]);

            // Redirect back to the index page with a success message
            return response()->json(['message' => 'Status toggled successfully', 'is_done' => $objective->is_done]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['message' => 'Failed to toggle objective status']);
        }
    }
}
