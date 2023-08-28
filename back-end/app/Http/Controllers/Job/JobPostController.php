<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\Job;

class JobPostController extends Controller
{

    public function getBusinessJobs()
    {
        try {
            $business = auth()->user();
            $jobs = $business->jobs;

            return response()->json([
                'jobs' => $jobs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching job posts',
                'error' => $e->getMessage()
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
            return response()->json([
                'message' => 'An error occurred while fetching job post details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(JobPostRequest $request)
    {
        try {
            $business = auth()->user();
            $job = new Job();
            $job->fill([
                $job->business_id = $business->id,
                $job->position = $request->input('position'),
                $job->level = $request->input('level'),
                $job->type = $request->input('type'),
                $job->skill = $request->input('skill'),
                $job->salary = $request->input('salary'),
                $job->content = $request->input('content'),
                $job->requirement = $request->input('requirement'),
                $job->quantity = $request->input('quantity'),
                $job->benefits = $request->input('benefits'),
                $job->start_day = $request->input('start_day'),
                $job->end_day = $request->input('end_day'),
                $job->status = false,
            ]);
            $job->save();

            return response()->json([
                'message' => 'Job post created successfully',
                'job' => $job
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the job post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(JobPostRequest $request, $jobId)
    {
        try {
            $business = auth()->user();
            $job = Job::findOrFail($jobId);

            if ($job->business_id !== $business->id) {
                return response()->json([
                    'message' => 'You are not authorized to update this job post'
                ], 403);
            }

            $job->fill([
                $job->business_id = $business->id,
                $job->position = $request->input('position'),
                $job->level = $request->input('level'),
                $job->skill = $request->input('skill'),
                $job->salary = $request->input('salary'),
                $job->content = $request->input('content'),
                $job->requirement = $request->input('requirement'),
                $job->quantity = $request->input('quantity'),
                $job->benefits = $request->input('benefits'),
                $job->start_day = $request->input('start_day'),
                $job->end_day = $request->input('end_day'),
                $job->status = false,
            ]);
            $job->update();

            return response()->json([
                'message' => 'Job post updated successfully',
                'job' => $job
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the job post',
                'error' => $e->getMessage()
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
            return response()->json([
                'message' => 'An error occurred while deleting the job post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
