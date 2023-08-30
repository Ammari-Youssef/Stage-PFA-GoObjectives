<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
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
            $query->where('UserID', $user->id);
        })->get();

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $objectives = Objective::where('UserID', auth()->id())->get();

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
        $task->load('objective');

        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return('task.edit');
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

    public function completeTask(Task $task)
    {
        // Perform any logic related to completing the task
        // ...

        // Create a result for the completed task
        $task->results()->create([
            'value' => 'Some result value',
            // ... other columns ...
        ]);

        // Redirect or return a response
        // ...
    }
}
