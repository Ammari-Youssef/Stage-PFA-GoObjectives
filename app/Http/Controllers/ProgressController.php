<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProgressRequest;
use App\Http\Requests\UpdateProgressRequest;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $categories = [
            'Health & Fitness', 'Relationships', 'Spirituality', 'Environment',
            'Free Time', 'Work & Business', 'Feelings', 'Money & Finance'
        ];

        $progressRecords = Progress::where('UserID', $userId)->get();

        $progressDataArray = []; // Initialize an array to store progress values for each category
        foreach ($categories as $category) {
            $progressDataArray[] = $progressRecords->pluck(strtolower(str_replace(' & ', '_', $category)))->first();
        }

        // dd([
        // //     // $progres,
        //     $progressDataArray,
        //     $progressRecords,
        // ]);

        return view('progress.index', compact('categories', 'progressRecords', 'progressDataArray'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('progress.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function  store(StoreProgressRequest $request)
    {
        $categories = Category::pluck('id')->toArray();
        $dynamicRules = [];
        foreach ($categories as $categoryID) {
            $dynamicRules["category_$categoryID"] = "required|numeric|min:0|max:10";
        }

        $validatedData = $request->validate($dynamicRules);

        $userID = Auth::id();
        
        // dd([
        //     $userID,
        //     $categories,
        //     $validatedData,
        // ]);

        foreach ($categories as $categoryID) {
            Progress::create([
                'UserID' => $userID,
                'CategoryID' => $categoryID,
                'value' => $validatedData["category_$categoryID"],
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Progress data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $userId = Auth::id(); // Get the logged-in user's id
        // $progressId = Progress::findorFail($id);
        // $categories = [
        //     'Health & Fitness', 'Relationships', 'Spirituality', 'Environment',
        //     'Free Time', 'Work & Business', 'Feelings', 'Money & Finance'
        // ];

        // $progressData = Progress::where('UserID', $userId)
        //     ->select('health_fitness', 'relationships', 'spirituality', 'environment', 'free_time', 'work_business', 'feelings', 'money_finance')
        //     ->get();

        // $progressDataArray = [
        //     $progressData->pluck('health_fitness')->first(),
        //     $progressData->pluck('relationships')->first(),
        //     $progressData->pluck('spirituality')->first(),
        //     $progressData->pluck('environment')->first(),
        //     $progressData->pluck('free_time')->first(),
        //     $progressData->pluck('work_business')->first(),
        //     $progressData->pluck('feelings')->first(),
        //     $progressData->pluck('money_finance')->first(),
        // ];
        // return view('progress.edit', compact('progressData', 'categories', 'progressDataArray', 'progressId'));
        $userId = Auth::id();
        $categories = Category::all();
        $progressData = Progress::where('UserID', $userId)->get();

        return view('progress.edit', compact('categories', 'progressData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgressRequest $request, Progress $progress)
        {
        //     $progress->update($request->validated());

        //     return redirect()->route('dashboard')->with('success', 'Progress data updated successfully.');
        $userId = Auth::id();
        $inputProgress = $request->input('progress');

        foreach ($inputProgress as $categoryId => $value) {
            Progress::where('UserID', $userId)
            ->where('CategoryID', $categoryId)
            ->update(['value' => $value]);
        }

        return redirect()->route('progress.index')->with('success', __('Progress updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        //
    }
}
