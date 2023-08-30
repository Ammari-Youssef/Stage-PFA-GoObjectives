<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObjectiveRequest;
use Illuminate\Http\Request;
use App\Models\Objective;
use Illuminate\Support\Facades\Auth;


class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Auth::id();

        $objectives = Objective::where('UserID', $userId)->get(); // Assuming you have an 'Objective' model
        // dd($objectives);
        return view('objective.index', compact('objectives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = [
            'Health & Fitness', 'Relationships', 'Spirituality', 'Environment',
            'Free Time', 'Work & Business', 'Feelings', 'Money & Finance'
        ];
        return view('objective.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObjectiveRequest $request)
    {
        // Get the validated data from the request
        $validatedData = $request->validated();

        // Handle logic based on the selected Type and PlanningType
        if ($validatedData['Type'] === 'essential') {
            // Handle essential type objectives
            // You can set additional fields or perform specific actions
            $validatedData['PlanningType'] = 'none'; // Set PlanningType to "none" for essential objectives
            $validatedData['PlanningDays'] = null;
            $validatedData['RestDays'] = null;
        } elseif ($validatedData['Type'] === 'number') {
            // Handle number type objectives
            // You can set additional fields or perform specific actions
            $validatedData['PlanningType'] = 'none'; // Set PlanningType to "none" for number objectives
            $validatedData['PlanningDays'] = null;
            $validatedData['RestDays'] = null;
        } elseif ($validatedData['Type'] === 'logic') {
            // Handle logic type objectives
            // You can set additional fields or perform specific actions
            $validatedData['PlanningType'] = 'none'; // Set PlanningType to "none" for logic objectives
            $validatedData['PlanningDays'] = null;
            $validatedData['RestDays'] = null;
        } elseif ($validatedData['Type'] === 'time') {
            // Handle time type objectives
            if ($validatedData['PlanningType'] === 'daily') {
                // Handle daily planning
            } elseif ($validatedData['PlanningType'] === 'weekly') {
                // Handle weekly planning
                // You may need to save the selected weekdays in the database
                // $validatedData['WeeklyDays'] will contain an array of selected days
            } elseif ($validatedData['PlanningType'] === 'periodic') {
                // Handle periodic planning
            }
        }
        //inserer
        // if($validatedData['Category']==="autre"){

        //     // Category::create($validatedData);
        //     $id_category= ->id;
        // }
        
        // Create the objective in the database
        Objective::create($validatedData);

        // Redirect back with success message
        return redirect()->route('objectives.index')->with('success', 'Objective created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //result 
    public function completeObjective(Objective $objective)
    {
        // Perform any logic related to completing the objective
        // ...

        // Create a result for the completed objective
        $objective->results()->create([
            'value' => 'Some result value',
            // ... other columns ...
        ]);

        // Redirect or return a response
        // ...
    }
}
