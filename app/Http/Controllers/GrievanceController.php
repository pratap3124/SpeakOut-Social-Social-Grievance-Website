<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grievance;
use Illuminate\Support\Facades\Auth;

class GrievanceController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Grievance::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Grievance submitted successfully!');
    }

    // Display all grievances submitted by the user
    public function responses()
    {
        $grievances = Grievance::where('user_id', Auth::id())->get();
        return view('grievance.responses', compact('grievances'));
    }

    public function feedback(Request $request, $id)
    {
        // Validate the feedback
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        // Find the grievance
        $grievance = Grievance::findOrFail($id);

        // Update the grievance with feedback and rating
        $grievance->feedback = $request->feedback;
        $grievance->rating = $request->rating;
        $grievance->save();

        return redirect()->route('grievance.responses')->with('success', 'Feedback submitted successfully!');
    }

}
