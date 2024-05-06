<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AcitivtyLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::orderBy('created_at', 'desc')->get();

        // Pass the activity logs to the view
        return view('admin.activity_log', compact('activityLogs'));
    }
}
