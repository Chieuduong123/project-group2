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

        // $applications = $business->jobApplications;
        $applications = Application::with(['seeker', 'job'])
            ->join('jobs', 'applications.job_id', '=', 'jobs.id')
            ->where('jobs.business_id', '=', $business->id)
            ->get();
        return response()->json([
            'applications' => $applications
        ]);
    }

    public function getDetailApplications($id)
    {
        $business = auth()->user();

        $application = Application::with(['seeker', 'job'])
            ->join('jobs', 'applications.job_id', '=', 'jobs.id')
            ->where('jobs.business_id', '=', $business->id)
            ->where('applications.id', '=', $id)
            ->get();
        return response()->json([
            'applications' => $application
        ]);
    }
}
