<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Tasks\StoreTaskRequest as StoreTaskRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\Objective;
use App\Models\Result;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        // Retrieve tasks associated with objectives belonging to the user
        $tasks = Task::whereHas('objective', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();


        $objectives = Objective::where('user_id', auth()->id())->get();
        return view('task.index', compact('tasks', 'objectives'));
    }

    public function tasksJson()
    {
        //
        $user = Auth::user();

        // Retrieve tasks associated with objectives belonging to the user
        $tasks = Task::whereHas('objective', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

dump($tasks);
        $objectives = Objective::where('user_id', auth()->id())->get();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $objectives = Objective::where('user_id', auth()->id())->get();

        return view('task.create', compact('objectives'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        // Create the task using the validated data
        Task::create($validatedData);

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Load related data if needed
        $task->load('objective'); // Load the related objective if necessary

        // Return the task data as JSON
        return response()->json($task);
        // return view('task.show',compact('task'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    // public function edit(Request $request)
    {
        // dd($request->id);
        // $objectives = Objective::where('user_id', auth()->id())->get();
        // $task = Task::find($request->id);
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        // Create the task using the validated data
        $description = strip_tags($validatedData['description']);
        $title = strip_tags($validatedData['title']);

        // Update the task with the new data from the request
        $task->update([
            'title' => $title,
            'description' => $description,
            'date' => $validatedData['date'],
            'objective_id' => $validatedData['objective_id'],

        ]);


        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('objective.index')->with('success', 'Objective deleted successfully.');
    }

    public function toggleStatus(Task $task)
    {
        try {
            // Toggle the 'is_done' status
            $task->update(['is_done' => !$task->is_done]);

            // Redirect back to the index page with a success message
            return response()->json(['message' => 'Status toggled successfully', 'is_done' => $task->is_done]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['message' => 'Failed to toggle task status']);
        }
    }

    
}
