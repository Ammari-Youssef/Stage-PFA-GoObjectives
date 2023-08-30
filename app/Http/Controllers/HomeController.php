<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Objective;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\Task;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        
        $userId = Auth::id(); // Get the logged-in user's id
        $categories= Category::all();

        // Fetch data for each model using the user's id
        // dd(Auth::user());
        $tasksData = Task::where('ObjectiveID', $userId)->get();
        $objectives = Objective::where('UserID', $userId)->get(); 
        $labels = $categories->pluck('name')->toArray();

       $colors = array_map(function () {   return '#' . substr(md5(rand()), 0, 6);  }, range(1, count($categories)));

        $progressData = Progress::where('UserID', $userId)->get(); // Fetch a single progress record
    dump([
           $progressData,
        ]);

        $progressDataArray = $categories->map(function ($category) use ($progressData) {
            return $progressData->where('CategoryID', $category->id)->first()->value ?? 0;
        })->toArray();
        
        // dd([
        // //     // $labels,
        //     // $progressDataArray,
        //     $progressData,
        // //     $objectivesData,
        // ]);

        return view('dashboard', compact('labels','tasksData', 'progressDataArray','progressData', 'objectives' , 'colors','categories'));
  
    }
}
