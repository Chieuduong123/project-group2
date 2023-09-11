<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function search(Request $request)
    {
        $query = Job::query();

        if ($request->has('position')) {
            $query->where('position', 'LIKE', '%' . $request->input('position') . '%');
        }

        if ($request->has('level')) {
            $levels = $request->input('level');
            if (!is_array($levels)) {
                $levels = [$levels];
            }
            $query->where(function ($query) use ($levels) {
                foreach ($levels as $level) {
                    $query->orWhere('level', 'LIKE', '%' . $level . '%');
                }
            });
        }

        if ($request->has('location')) {
            $query->whereHas('business', function ($q) use ($request) {
                $q->where('location', 'LIKE', '%' . $request->input('location') . '%');
            });
        }

        $results = $query
            ->with('business')
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json($results);
    }
    public function getJobPosting()
    {
        $showJob = Job::with('business')
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->makeHidden(['updated_at', 'status']);

        return response()->json($showJob);
    }

    public function getDetailJobPosting($id)
    {
        $job = Job::with('business')
            ->where('id', $id)
            ->first();

        return response()->json($job);
    }

    public function getJobByBusiness($business)
    {
        $jobs = Job::with('business')
            ->where('business_id', '=', $business)
            ->where(function ($query) {
                $query->where('status', true);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($jobs);
    }

    public function jobsWithHighest()
    {
        $jobsWithFavorites = Job::withCount('favorites')
            ->having('favorites_count', '>=', 5)
            ->get();

        $jobsWithApplications = Job::withCount('applications')
            ->having('applications_count', '>=', 10)
            ->get();

        $jobs = $jobsWithFavorites->union($jobsWithApplications);

        return response()->json(['jobs' => $jobs]);
    }
}
