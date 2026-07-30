<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;



class ActivityLogController extends Controller{
    public function index(Request $request) {

        $query = ActivityLog::with('user');
    
        // 👤 NEW: My Logs Filter (Only fetch logs created by the logged-in user)
        if ($request->has('my_logs')) {
            $query->where('user_id', auth()->id());
        }
    
        // 🔍 Search Filter (Title, Description, Remarks, or Agent Name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('activity_title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('remarks', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
    
        // 📅 Date Range Filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        } elseif ($request->has('handover')) {
            $query->whereDate('created_at', now()->today());
        }
    
        $activities = $query->latest()->paginate(10)->withQueryString();
    
        return view('dashboard', compact('activities'));
    }
    

    public function store(Request $request){
        $request->validate([
            'activity_title' => 'required|string|max:255',
            'description'    => 'required|string',
            'status'         => 'required|in:Pending,In Progress,Done',
            'remarks'        => 'nullable|string',
        ]);

        $request->user()->activityLogs()->create($request->only([
            'activity_title',
            'description',
            'status',
            'remarks'
        ]));

        return redirect()->back()->with('success', 'Activity logged successfully!');
    }

 public function update(Request $request, ActivityLog $activity)
    {
        $validated = $request->validate([
            'activity_title' => 'required|string|max:255',
            'description'    => 'required|string',
            'status'         => 'required|in:Pending,In Progress,Done',
            'remarks'        => 'nullable|string|max:255',
        ]);

        $activity->update($validated);

        return redirect()->route('dashboard')->with('success', 'Activity updated successfully!');
    }

    public function destroy(ActivityLog $activity)
    {
        $activity->delete();

        return redirect()->route('dashboard')->with('success', 'Activity deleted successfully!');
    }



public function exportCsv(Request $request){
    $fileName = 'support_activity_report_' . date('Y-m-d') . '.csv';

    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // Build query based on active date filters
    $query = ActivityLog::with('user');

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
        ]);
    } elseif ($request->has('handover')) {
        $query->whereDate('created_at', now()->today());
    }

    $logs = $query->latest()->get();

    $callback = function() use ($logs) {
        $file = fopen('php://output', 'w');
        
        // CSV Column Headers
        fputcsv($file, ['ID', 'Activity Title', 'Description', 'Status', 'Remarks / Handover', 'Logged By', 'Logged At']);

        // CSV Rows
        foreach ($logs as $log) {
            fputcsv($file, [
                $log->id,
                $log->activity_title,
                $log->description,
                $log->status,
                $log->remarks,
                $log->user ? $log->user->name : 'N/A',
                $log->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($file);
    };

    

    return response()->stream($callback, 200, $headers);
}




  

   




}



