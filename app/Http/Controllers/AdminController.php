<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grievance;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $filter = $request->query('filter');

        $query = Grievance::orderByDesc('created_at');

        switch ($filter) {
            case 'pending':
                $query->whereNull('response');
                break;
            case 'resolved':
                $query->whereNotNull('response');
                break;
            case 'feedback':
                $query->whereNotNull('response')->whereNotNull('feedback');
                break;
            default:
                // no filter
                break;
        }

        $grievances = $query->get();

        return view('admin.dashboard', compact('grievances', 'filter'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $grievance = Grievance::findOrFail($id);
        $grievance->response = $request->response;
        $grievance->status = 'Resolved';
        $grievance->save();

        return redirect()->route('admin.dashboard')->with('success', 'Response submitted successfully!');
    }
}
