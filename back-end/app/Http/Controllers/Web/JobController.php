<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function home()
    {
        $jobs = Job::where('status', true)->orderByDesc('id')->offset(0)->limit(6)->get();
        return view('pages.home', compact('jobs'));
    }

    public function listJobs()
    {
        $jobs = Job::where('status', true)->paginate(6);
        return view('pages.list-jobs', compact('jobs'));
    }

    public function jobDetail($id)
    {
        $jobs = Job::where('id', '=', $id)->get();
        return view('pages.job-detail', compact('jobs'));
    }

    public function applyJob(Request $request, $jobId)
    {
        try {
            $seeker = auth()->guard('web-seeker')->user();

            $existingApplication = Application::where('seeker_id', $seeker->id)
                ->where('job_id', $jobId)
                ->first();

            if ($existingApplication) {
                return redirect()->back()->withErrors([
                    'message' => 'You have already applied for this job.'
                ]);
            }

            $job = Job::where('status', 1)->findOrFail($jobId);

            $request->validate([
                'resume_path' => 'required|mimes:pdf|max:2048',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'cover_letter' => 'nullable|string',
            ]);

            $filename = null;
            if ($request->hasFile('resume_path')) {
                $file = $request->file('resume_path');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('cv'), $filename);
            }

            $application = new Application();
            $application->seeker_id = $seeker->id;
            $application->job_id = $jobId;
            $application->name = $request->input('name');
            $application->phone = $request->input('phone');
            $application->cover_letter = $request->input('cover_letter', '');
            $application->resume_path = $filename;
            $application->save();

            return redirect()->back()->with('success', 'Your application has been submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage() . ' --- Line: ' . $e->getLine());

            return redirect()->back()->withErrors([
                'message' => 'An error occurred while submitting the application. Please try again later.'
            ]);
        }
    }
}
