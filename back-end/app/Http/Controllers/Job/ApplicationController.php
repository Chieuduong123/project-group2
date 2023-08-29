<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;


class ApplicationController extends Controller
{
    public function getApplications()
    {
        $business = auth()->user();

        $applications = $business->jobApplications;

        return response()->json([
            'applications' => $applications
        ]);
    }
}
