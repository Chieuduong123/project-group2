<?php

namespace App\Http\Services;

use App\Http\Repositories\ApplicationRepository;
use Illuminate\Support\Facades\Validator;

class ApplicationService
{
    protected $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }
    public function applyForJob($seeker, $jobId, $request)
    {
        $validator = Validator::make($request, [
            'resume_path' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        if ($file = $request->file('resume_path')) {
            $file = $request->file('resume_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('cv'), $filename);
            $applicationData  = [
                'seeker_id' => $seeker->id,
                'job_id' => $jobId,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'cover_letter' => $request->input('cover_letter'),
                'resume_path' => $filename,
            ];

            $application = $this->applicationRepository->create($applicationData);
        }

        return $application;
    }
}
