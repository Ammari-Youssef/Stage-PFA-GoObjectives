<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'planning_id' => 'required|exists:plannings,id',
            'objective_id' => 'required|exists:objectives,id',
        ]);

        // Create a new level
        Level::create($validatedData);

        // Optionally, you can return a success response or redirect
        return response()->json(['message' => 'Level created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        return response()->json($level);
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
    public function update(Request $request, Level $level)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            // Update the level with the new data
            $level->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            return response()->json(['message' => 'Level updated successfully' , 'level'=>$level], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the level'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Level $level)
    {
        try {
            // Toggle the 'status' status
            $level->update(['status' => !$level->status]);

            // Redirect back to the index page with a success message
            return response()->json(['message' => 'Status toggled successfully', 'status' => $level->status]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['message' => 'Failed to toggle level status']);
        }
    }
}
