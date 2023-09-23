<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Tasks\StoreTaskRequest as StoreTaskRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\Objective;
use App\Models\Result;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }
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
        $completedTaskCount = $tasks->where('is_done', true)->count();
        $TaskCount = $tasks->count();
       
      
        // dump([$tasks, $completedTaskCount, $TaskCount]);
        
        $objectives = Objective::where('user_id', auth()->id())->get();

        
        return view('task.index', compact('tasks', 'objectives', 'completedTaskCount', 'TaskCount'));
    }
    public function getTasks()
    {
        $tasks = Task::all();

        $events = [];

        foreach ($tasks as $task) {
            $events[] = [
                'title' => $task->title,
                'start' => $task->date, 
                'end' => $task->date,     
                'backgroundColor' => $task-> is_done ? 'green' :   'red'
            ];
        }
       
        return response()->json($events);
    }

    public function getTaskCounts(Request $request){
        $startOfMonth = $request->input('startOfMonth')?? Carbon::now()->startOfMonth();
        $endOfMonth = $request->input('endOfMonth')??Carbon::now()->endOfMonth();

       
        $tasks = Task::whereHas('objective', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where('user_id', Auth::id());
        })
            ->where('date', '>=', $startOfMonth)
            ->where('date', '<=', $endOfMonth)
            ->get();

        $completedTaskCount = $tasks->where('is_done', true)->count();
        $taskCount = $tasks->count();

        return response()->json([
            'completedTasks' => $completedTaskCount,
            'totalTasks' => $taskCount
        ]);
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
        return response()->json(['message' => 'Task deleted successfully', 'task_id' => $task->id]);
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
