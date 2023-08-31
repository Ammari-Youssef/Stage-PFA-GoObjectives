<?php

namespace App\Http\Controllers;

use App\Models\Motive;
use App\Models\Objective;
use Illuminate\Http\Request;

class MotiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $objectiveId = $request->input('objective_id');

        return view('motive.create',["ObjectiveId"=> $objectiveId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'ObjectiveID' => 'required|exists:objectives,id',
            'MotiveType' => 'required|string|max:255',
            'MotiveTitle' => 'required|string|max:255',
            'MotiveDescription' => 'required|string',
        ]);

        Motive::create([
            'ObjectiveID' => $request->ObjectiveID,
            'MotiveType' => $request->MotiveType,
            'MotiveTitle' => $request->MotiveTitle,
            'MotiveDescription' => $request->MotiveDescription,
        ]);

        return redirect()->route('objective.index')
        ->with('success', 'Motive created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('motive.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('motive.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motive $motive)
    {
        $validatedData = $request->validate([
            'MotiveType' => 'required|in:reason,reward,penalty',
            'MotiveTitle' => 'required|string|max:255',
            'MotiveDescription' => 'required|string',
        ]);

        $motive->update([
            'MotiveType' => $validatedData['MotiveType'],
            'MotiveTitle' => $validatedData['MotiveTitle'],
            'MotiveDescription' => $validatedData['MotiveDescription'],
        ]);

        return redirect()->route('motive.show', $motive->id)
            ->with('success', __('Motive updated successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     */
   
    public function destroy(Motive $motive)
    {
        $motive->delete();

        return redirect()->route('objective.show', $motive->ObjectiveID)
            ->with('success', __('Motive deleted successfully.'));
    
    }
}
