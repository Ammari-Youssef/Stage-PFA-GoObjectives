<?php

namespace App\Http\Controllers;

use App\Http\Requests\Objectives\StoreObjectiveRequest;
use App\Models\Category;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Models\Objective;
use App\Models\Planning;
use App\Models\PlanningType;
use App\Models\Result as ModelsResult;
use Illuminate\Support\Facades\Auth;


class ObjectiveController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Objective::class, 'objective');
    }

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
    public function create(Objective $objective, Request $request)
    {
        $objective_parent_id = $request->input('objective_parent_id');

        $categories = Category::all();
        $planningTypes = PlanningType::all();
        // dump([
        //     "type of plans" => $planningTypes,
        //     "parent id " => $objective_parent_id,
        // ]);

        return view('objective.create', compact('objective', 'objective_parent_id', 'categories', 'planningTypes'));
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

        // Check if a default level should be created and associated with the objective

        // Create the default level
        $defaultLevelData = [
            'title' => 'Default', // Customize as needed
            'planning_id' => $planning->id,
            'objective_id' => $mainObjective->id,
        ];
        // Determine the description based on the planning type
        if ($planningType->name === 'daily') {
            $defaultLevelData['description'] = 'You have to do this every single day.';
        } elseif ($planningType->name === 'weekly or multiple times a week') {
            $selectedWeekDays = $request->input('selected_week_days');
            $weekDaysString = implode(' & ', $selectedWeekDays);
            $defaultLevelData['description'] = "You should do that during: $weekDaysString.";
        } elseif ($planningType->name === 'periodic') {
            $numberOfDays = $request->input('number_of_days');
            $numberOfRestDays = $request->input('number_of_rest_days');
            $defaultLevelData['description'] = "You should do that for $numberOfDays days and rest for $numberOfRestDays days.";
        }

        // Create the default level
        $defaultLevel = Level::create($defaultLevelData);




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
        //Reformat the target time inputed 
        $targetTime = $objective->target_time;
        $hours = date('H', strtotime($targetTime));
        $minutes = date('i', strtotime($targetTime));
        $seconds = date('s', strtotime($targetTime));
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
        //Showing Results if any
        $results = ModelsResult::where('objective_id', $objective->id)->orderBy('result_date')->get();

        $numberData = [];
        $timeData = [];
        $behavioralData = [];
        $labels = [];
        $averageNumberData = [];
        $averageTimeData = [];

        $numberTotal = 0;
        $timeTotal = 0;
        $numberCount = 0;
        $timeCount = 0;

        foreach ($results as $result) {
            $labels[] = $result->result_date;

            if (
                $result->number_value !== null
            ) {
                $numberData[] = $result->number_value;
                $numberTotal += $result->number_value;
                $numberCount++;
                $averageNumberData[] = $numberTotal / $numberCount;
            } else {
                $numberData[] = null;
                $averageNumberData[] = null;
            }

            if ($result->experience_time_value !== null) {
                $timeData[] = strtotime($result->experience_time_value);
                $timeTotal += strtotime($result->experience_time_value);
                $timeCount++;
                $averageTimeData[] = $timeTotal / $timeCount;
            } else {
                $timeData[] = null;
                $averageTimeData[] = null;
            }

            if ($result->behavior_result !== null) {
                $behavioralData[] = $result->behavior_result;
                $behavioralCounts = array_count_values(array_filter($behavioralData, function ($value) {
                    return $value !== null;
                }));

            } else {
                $behavioralData[] = null;
            }
        }
        // Get the count of 'true' and 'false'
        $DidItCount = $behavioralCounts[true] ?? 0;
        $DidNotDoItCount = $behavioralCounts[false] ?? 0;

        $planningdaysCount = 0; // Initialize the variable with a default value

        $planningdaysCount = 
        $objective->planning->planning_type_id == 1
        ? 7
        : ($objective->planning->planning_type_id == 3
            ? $objective->planning->number_of_days
            : ($objective->planning->planning_type_id == 2
                ? count($objective->planning->selected_week_days)
                : 0 // Default value if none of the conditions match
            )
        );

        // dump([
        //     'objective level' => $objective->levels,
        //     'sub goals' => $subobjectives,
        //     'result' => $results,
        //     'number data' => $numberData,
        //     'time data' => $timeData,
        //     'behavior data' => $behavioralData,
        //     'labels' => $labels,
        //     'average number data' => $averageNumberData, 
        //     'average time data' => $averageTimeData,
        //     'DidItCount' => $DidItCount,
        //     'DidNotDoItCount' => $DidNotDoItCount,
        //     'planningdaysCount' => $planningdaysCount,
        // ]);
        return view('objective.show', compact('objective', 'subobjectives', 'results', 'formattedTime', 'numberData', 'timeData', 'behavioralData', 'labels', 'averageNumberData', 'averageTimeData', 'DidItCount','DidNotDoItCount', 'planningdaysCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Objective $objective, Request $request)
    {
        
        
        $objective_parent_id = $request->input('objective_parent_id');

        $categories = Category::all();
        $planningTypes = PlanningType::all();
        // dump([
        //     "type of plans" => $planningTypes,
        //     "parent id " => $objective_parent_id,
        // ]);

        return view('objective.edit', compact('objective', 'objective_parent_id', 'categories', 'planningTypes'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreObjectiveRequest $request, $id)
    {
        $objective = Objective::findOrFail($id);
        // Authorize the user to update the objective
        
        // Get the validated data from the request
        $validatedData = $request->validated();


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

        return response()->json(['message' => 'Objective deleted successfully', 'objective_id' => $objective->id]);
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
