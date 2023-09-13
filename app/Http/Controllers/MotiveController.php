<?php

namespace App\Http\Controllers;

use App\Http\Requests\Motives\StoreRequest;
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

        return view('motive.create', compact('objectiveId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $validateData = $request->validated();
        // dd($validateData);
        Motive::create([
            'objective_id' => $request->objective_id,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('objective.show', ['objective' => $request->objective_id])
            ->with('success', 'Motive created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motive $motive)
    {
        //
        return view('motive.show' , compact('motive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motive $motive)
    {
        //
        return view('motive.edit', compact('motive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motive $motive)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:reason,reward,penalty',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $motive->update([
            'type' => $validatedData['type'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('motive.show', $motive->id)
            ->with('success', __('Motive updated successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Motive $motive)
    {
        // Delete the motive
        $motive->delete();

        return response()->json(['message' => 'Motive deleted successfully' , 'motive_id'=>$motive->id]);
    }

}
