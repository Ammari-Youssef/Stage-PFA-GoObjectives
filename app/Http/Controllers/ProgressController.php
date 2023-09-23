<?php

namespace App\Http\Controllers;

use App\Http\Requests\Progress\StoreProgressRequest;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Category;


class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $progressRecords = Progress::where('user_id', $userId)->get();
        // Fetch progress data from the database
        $progressData = Progress::select('rating')->get();

        // Prepare data for the chart
        $labels = Category::all()->pluck('name')->toArray(); // Assuming you have a Category model

        $colors = array_map(function () {
            return '#' . substr(md5(rand()), 0, 6);
        }, range(1, count($labels)));
        $values = $progressRecords->pluck('rating')->toArray();

        $summaryStatistics = $this->calculateSummaryStatistics($progressRecords);
        $userInsights = $this->generateUserInsights($progressRecords);
        // dump([
        //     // $progress,
        //     //     $progressDataArray,
        //     "progress records" => $progressRecords->count(),
        //     "values" => $values,
        //     "lable" =>  $labels,
        //     "static"=> $summaryStatistics
        // ]);

        return view('progress.index', compact('labels', 'values', 'progressRecords', 'colors', 'userId', 'summaryStatistics', 'userInsights'));

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
        //   "id user "=>  $userID,
        //     $categories,
        //     $validatedData,
        // ]);

        foreach ($categories as $categoryID) {
            Progress::create([
                'user_id' => $userID,
                'category_id' => $categoryID,
                'rating' => $validatedData["category_$categoryID"],
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Progress data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $progress = Progress::findOrFail($id);

        $rating = $progress->rating;

        if ($rating ==0) {
            $insights = 'Invalid rating. Please provide a rating between 0 and 10.';
    
        }
        if ($rating < 3) {
            $ratingClass = 'low-rating';
            $insights = "<span class='$ratingClass' style='color:red'><i class='fas fa-exclamation-triangle'></i></span> Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is consistently low. Consider taking actions to improve in this area.";
        } elseif ($rating >= 3 && $rating < 6) {
            $ratingClass = 'moderate-rating';
            $insights = "<span class='$ratingClass' style='color:gold'><i class='fas fa-info-circle'></i></span> Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is in the moderate range. There is room for improvement.";
        } elseif ($rating >= 6 && $rating < 8) {
            $ratingClass = 'good-rating';
            $insights = "<span class='$ratingClass' style='color:#00FF00'><i class='fas fa-check-circle'></i></span> Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is good, but there is still room for enhancement.";
        } elseif ($rating >= 8 && $rating <= 10) {
            $ratingClass = 'excellent-rating';
            $insights = "<span class='$ratingClass' style='color:green'><i class='fas fa-star'></i></span> Congratulations! Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is excellent.";
        } else {
            $insights = 'Invalid rating. Please provide a rating between 0 and 10.';
        }

        return view('progress.show', compact('progress', 'insights'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userId = Auth::id(); // Get the logged-in user's id
        $progressID = Progress::findorFail($id);
        $user_progress = Progress::findorFail($userId);

        $categories = Category::all();
        $UserProgressData = Progress::where('user_id', $userId)->get();

        // dump([
        //     // $UserProgressData, 
        //     'userprogress' => $user_progress,
        //     $progressID
        // ]);
        return view('progress.edit', compact('categories', 'UserProgressData', 'progressID', 'userId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'progress' => 'required|array', // Ensure 'progress' is an array
            'progress.*' => 'numeric|between:0,10', // Ensure progress ratings are numeric and between 0 and 10
        ]);

        try {
            // Loop through the submitted progress data and update the corresponding records
            foreach ($validatedData['progress'] as $categoryId => $rating) {
                // Find the user's progress record for the category
                $progressRecord = Progress::where('user_id', $userId)
                    ->where('category_id', $categoryId)
                    ->first();

                if ($progressRecord) {
                    // Update the progress rating for the category
                    $progressRecord->rating = $rating;
                    $progressRecord->save();
                }
            }

            // Redirect back with a success message
            return redirect()->route('progress.index')->with('success', 'Progress updated successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions or errors that may occur during the update process
            return redirect()->route('progress.index')->with('error', 'Error updating progress. Please try again.');
        }
    }
    public function update_single_rating(Request $request)
    {
        // Validate the incoming data
        // $request->validate([
        //     'rating' => 'required|numeric|min:0|max:10',
        // ]);

        // // Retrieve the progress record to update
        // $progress = Progress::find($request->input('progress_id'));
        // // Update the progress record
        // $progress->rating = $request->input('rating');
        // $progress->save();

        // $userId = Auth::id();
        // $progressRecords = Progress::where('user_id', $userId)->paginate(10);

        // $output = '';
        // foreach ($progressRecords as $progress) {
        //     $name= $progress->category->name;
        //     $id=$progress->id;
        //     $rating= $progress->rating;
        //     $output .= '<x-charts.single-data-percentage-bar label="'.$name. '"
        //                                 value="' . $rating . '" max="10" id="'.$id.'"
        //                                 type="edit" />

        //                             <x-edit-progress-rating-modal modalId='."editProgressModal". '
        //                                 modalLabel="Edit Progress"
        //                                 formAction="#" :inputName="$progress->category->name"
        //                                 rating="' . $rating . '" :id="' . $id . '" />

        //                                 <x-show-progress-modal :progress="$progress"/> ' ;
        // }

        // dd($output);
        // return response()->json(['status'=> $output ,]);
        // $data = [];

        // foreach ($progressRecords as $progress) {
        //     $data[] = [
        //         'label' => $progress->category->name,
        //         'value' => $progress->rating,
        //         'id' => $progress->id,
        //         'inputName' => $progress->category->name,
        //     ];
        // }

        // return response()->json(['data' => $data]);



        $request->validate([
            'rating' => 'required|numeric|min:0|max:10',
            'progress_id' => 'required|exists:progress,id', // Add validation for progress_id
        ]);

        $progress = Progress::find($request->input('progress_id'));

        if (!$progress) {
            return response()->json([
                'success' => false,
                'message' => 'Progress record not found.',
            ]);
        }

        $progress->rating = $request->input('rating');
        $progress->save();

        return response()->json([
            'success' => true,
            'message' => $progress->category->name . " rating has been updated",
            'updatedRating' => $progress->rating, // Send the updated rating
            'progress_id' =>  $progress->id, // Send the escaped input name
            'max' =>  10, // Send the escaped input name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        try {
            $progress->rating = 0;
            // Save the changes to the database
            $progress->save();
            return redirect()->route('progress.index')->with('success', 'Progress record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('progress.index')->with('error', 'Error deleting progress record');
        }
    }


    public function generateUserInsights($progressData)
    {
        // Analyze $progressData and generate insights
        $insights = [];
        foreach ($progressData as $progress) {
            $rating = $progress->rating;

            if ($rating < 3) {
                $ratingClass = 'low-rating';
                $insights[] = "<span class='$ratingClass' style='color:red'><i class='fas fa-exclamation-triangle'></i></span> Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is consistently low. Consider taking actions to improve in this area.";
            } elseif ($rating >= 3 && $rating < 6) {
                $ratingClass = 'moderate-rating';
                $insights[] = "<span class='$ratingClass' style='color:gold'><i class='fas fa-info-circle'></i></span> Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is in the moderate range. There is room for improvement.";
            } elseif ($rating >= 6 && $rating < 8) {
                $ratingClass = 'good-rating';
                $insights[] = "<span class='$ratingClass' style='color:#00FF00'><i class='fas fa-check-circle'></i></span> Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is good, but there is still room for enhancement.";
            } elseif ($rating >= 8 && $rating <= 10) {
                $ratingClass = 'excellent-rating';
                $insights[] = "<span class='$ratingClass' style='color:green'><i class='fas fa-star'></i></span> Congratulations! Your rating for <b class='$ratingClass'>{$progress->category->name}</b> is excellent.";
            } else {
                $insights[] = "Invalid rating. Please provide a rating between 0 and 10.";
            }
        }

        return $insights;
    }

    public function calculateSummaryStatistics($progressData)
    {
        $ratings = $progressData->pluck('rating');

        return [
            'averageRating' => $ratings->avg(),
            'minRating' => $ratings->min(),
            'maxRating' => $ratings->max(),
        ];
    }
}
