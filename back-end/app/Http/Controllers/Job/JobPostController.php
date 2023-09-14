<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Http\Services\JobService;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobPostController extends Controller
{
    private $jobService;
    public function __construct(
        JobService $jobService
    ) {
        $this->jobService = $jobService;
    }
    public function getBusinessJobs()
    {
        try {
            $business = auth()->user();
            $jobs = $business->jobs;

            return response()->json([
                'jobs' => $jobs
            ]);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while fetching job posts',
            ], 500);
        }
    }

    public function getBusinessJobDetail($jobId)
    {
        try {
            $business = auth()->user();
            $job = Job::findOrFail($jobId);

            if ($job->business_id !== $business->id) {
                return response()->json([
                    'message' => 'You are not authorized to view this job post'
                ], 403);
            }

            return response()->json([
                'job' => $job
            ]);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while fetching job post details',
            ], 500);
        }
    }

    public function store(JobPostRequest $request)
    {
        try {
            $jobData = $request->all();
            $job = $this->jobService->createJob($jobData);

            return response()->json([
                'message' => 'Job post created successfully',
                'job    ' => $job
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while creating the job post',
            ], 500);
        }
    }

    public function update(Request $request, $jobId)
    {
        try {
            $business = auth()->user();
            $job = Job::findOrFail($jobId);

            if ($job->business_id !== $business->id) {
                return response()->json([
                    'message' => 'You are not authorized to update this job post'
                ], 403);
            }

            $jobData = $request->all();
            $job = $this->jobService->updateJob($job, $jobData);

            return response()->json([
                'message' => 'Job post updated successfully',
                'job' => $job
            ]);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while updating the job post',
            ], 500);
        }
    }

    public function destroy($jobId)
    {
        try {
            $business = auth()->user();
            $job = Job::findOrFail($jobId);

            if ($job->business_id !== $business->id) {
                return response()->json([
                    'message' => 'You are not authorized to delete this job post'
                ], 403);
            }
            $job->delete();

            return response()->json([
                'message' => 'Job post deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while deleting the job post',
            ], 500);
        }
    }
}
