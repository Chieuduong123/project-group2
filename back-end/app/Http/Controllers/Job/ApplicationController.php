<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    public function getApplications()
    {
        $business = auth()->user();

        $applications = Application::with(['seeker', 'job'])
            ->whereHas('job', function ($query) use ($business) {
                $query->where('business_id', $business->id);
            })
            ->get();

        return response()->json([
            'applications' => $applications
        ], 200);
    }
    public function getDetailApplications($id)
    {
        $business = auth()->user();

        $application = Application::with(['seeker', 'job'])
            ->whereHas('job', function ($query) use ($business) {
                $query->where('business_id', $business->id);
            })
            ->where('applications.id', '=', $id)
            ->get();
        return response()->json([
            'application' => $application
        ], 200);
    }
}
