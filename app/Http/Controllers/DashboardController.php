<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Objective;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        
        $userId = Auth::id(); // Get the logged-in user's id
        $categories= Category::all();
        $today = Carbon::now();
        // Fetch data for each model using the user's id
        $user = auth()->user();
        //tasks of today
        $tasks = Task::whereDate('date', now()->toDateString())->whereHas('objective', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

        $objectives = Objective::where('user_id', $userId)
        ->whereDate('end_date', '>=', $today) // Filter by end_date >= today
        ->whereDate('start_date', '<=', $today) // Filter by end_date >= today
        ->orderBy('start_date', 'desc')
        ->get();
        
        $labels = $categories->pluck('name')->toArray();

       $colors = array_map(function () {   return '#' . substr(md5(rand()), 0, 6);  }, range(1, count($labels)));

        $progressData = Progress::where('user_id', $userId)->get();
  
        
        $progressDataArray = $progressData->pluck('rating')->toArray();
        
        dump([
            $userId,
            Auth::check(),
            auth()->user()->id,
        // //     // $labels,
        "progress data all :"=>$progressData,
        "progress rating data "=>$progressDataArray,
            $objectives,
        ]);

        return view('dashboard', compact('labels','tasks', 'progressDataArray','progressData', 'objectives' , 'colors','categories','userId'));
  
    }
}
