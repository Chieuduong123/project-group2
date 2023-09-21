<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Services\RecommendJobService;
use App\Models\Job;
use App\Models\RecommendJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    private $recommendJobService;
    public function __construct(
        RecommendJobService $recommendJobService
    ) {
        $this->recommendJobService = $recommendJobService;
    }
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
        try {
            $job = Job::find($id);
            if ($job->status == false) {
                return response()->json([
                    'message' => 'You are not display this job post'
                ], 403);
            }
            $job->update([
                'view_count' => $job->view_count + 1,
            ]);
            $job->business;

            return response()->json($job);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while fetching job',
            ], 500);
        }
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
            ->with('business')
            ->having('favorites_count', '>=', 3)
            ->get();

        $jobsWithApplications = Job::withCount('applications')
            ->with('business')
            ->having('applications_count', '>=', 5)
            ->get();

        $jobs = $jobsWithFavorites->union($jobsWithApplications);

        return response()->json(['jobs' => $jobs]);
    }

    public function recommendJob()
    {
        $seeker = auth()->user();
        $recommendJob = RecommendJob::where('seeker_id', $seeker->id)->first();

        // compare job between -recommend_jobs- and -jobs- 
        $matchingJobs = Job::with(['business'])
            ->where('status', true)
            ->where(function ($query) use ($recommendJob) {
                $query->where(function ($subQuery) use ($recommendJob) {
                    if (is_array($recommendJob->skill) || is_object($recommendJob->skill)) {
                        foreach ($recommendJob->skill as $skill) {
                            $subQuery->where('skill', 'like', '%' . $skill . '%');
                        }
                    }
                    if (is_array($recommendJob->type) || is_object($recommendJob->type)) {
                        foreach ($recommendJob->type as $type) {
                            $subQuery->where('type', 'like', '%' . $type . '%');
                        }
                    }
                    if (is_array($recommendJob->level) || is_object($recommendJob->level)) {
                        foreach ($recommendJob->level as $level) {
                            $subQuery->where('level', 'like', '%' . $level . '%');
                        }
                    }
                    $subQuery->where('salary', '>=', $recommendJob->salary)
                        ->orWhere('position', 'like', '%' . $recommendJob->position . '%');
                })
                    ->orWhereHas('business', function ($businessQuery) use ($recommendJob) {
                        $businessQuery->where('location', 'like', '%' . $recommendJob->location . '%');
                    });
            })
            ->get();


        if ($matchingJobs->isEmpty()) {
            $matchingJobs = Job::with(['business'])
                ->where('status', true)
                ->where(function ($query) use ($recommendJob) {
                    $query->where('position', 'like', '%' . $recommendJob->position . '%')
                        ->orWhere(function ($subQuery) use ($recommendJob) {
                            $subQuery->whereHas('business', function ($businessQuery) use ($recommendJob) {
                                $businessQuery->where('location', 'like', '%' . $recommendJob->location . '%');
                            });
                        });
                })
                ->get();
        }

        return response()->json(['matching_jobs' => $matchingJobs]);
    }
}
