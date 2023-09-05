<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Objective;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\Task;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        
        $userId = Auth::id(); // Get the logged-in user's id
        $categories= Category::all();

        // Fetch data for each model using the user's id
        // dd(Auth::user());
        $tasks = Task::where('objective_id', $userId)->get();
        $objectives = Objective::where('user_id', $userId)->get(); 
        $labels = $categories->pluck('name')->toArray();

       $colors = array_map(function () {   return '#' . substr(md5(rand()), 0, 6);  }, range(1, count($labels)));

        $progressData = Progress::where('user_id', $userId)->get();
  
        
        $progressDataArray = $progressData->pluck('rating')->toArray();
        
        dump([
        // //     // $labels,
        "progress data all :"=>$progressData,
        "progress rating data "=>$progressDataArray,
        // //     $objectivesData,
        ]);

        return view('dashboard', compact('labels','tasks', 'progressDataArray','progressData', 'objectives' , 'colors','categories','userId'));
  
    }
}
