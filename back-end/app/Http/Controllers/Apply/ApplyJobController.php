<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;
use App\Http\Services\ApplicationService;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApplyJobController extends Controller
{
    public function applyForJob(Request $request, $jobId)
    {
        try {
            $seeker = auth()->user();

            $existingApplication = Application::where('seeker_id', $seeker->id)
                ->where('job_id', $jobId)
                ->first();

            if ($existingApplication) {
                return response()->json([
                    'message' => 'You have already applied for this job'
                ], 403);
            }

            $job = Job::where('status', 1)->findOrFail($jobId);

            $validator = Validator::make(
                $request->all(),
                [
                    'resume_path' => 'required|mimes:pdf|max:2048',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            if ($files = $request->file('resume_path')) {
                $file = $request->file('resume_path');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('cv'), $filename);
                $application = new Application();
                $application->fill([
                    $application->seeker_id = $seeker->id,
                    $application->job_id = $jobId,
                    $application->name = $request->input('name'),
                    $application->phone = $request->input('phone'),
                    $application->cover_letter = $request->input('cover_letter'),
                    $application->resume_path = $filename,
                ]);
                $application->save();
            }
            return response()->json([
                'message' => 'Application submitted successfully',
                'application' => $application
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while submitting the application',
            ], 500);
        }
    }

    public function getApplicationHistory()
    {
        $seeker = auth()->user();

        $applicationHistory = Application::where('seeker_id', $seeker->id)
            ->with(['job', 'job.business'])
            ->get();

        return response()->json([
            'application_history' => $applicationHistory
        ]);
    }
}
