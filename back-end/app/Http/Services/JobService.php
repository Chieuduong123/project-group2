<?php

namespace App\Http\Services;

use App\Http\Repositories\JobRepository;

class JobService
{
    private $jobRepository;

    public function __construct(

        JobRepository $jobRepository
    ) {

        $this->jobRepository = $jobRepository;
    }

    public function createJob(array $data)
    {
        $business = auth()->user();

        $jobData = [
            'business_id' => $business->id,
            'position' => $data['position'],
            'type' => $data['type'],
            'level' => $data['level'],
            'salary' => $data['salary'],
            'skill' => $data['skill'],
            'content' => $data['content'],
            'requirement' => $data['requirement'],
            'quantity' => $data['quantity'],
            'benefits' => $data['benefits'],
            'start_day' => $data['start_day'],
            'end_day' => $data['end_day'],
            'status' => false,
        ];
        $job = $this->jobRepository->create($jobData);

        return $job;
    }

    public function updateJob($job, $data)
    {
        $this->jobRepository->update($job, $data);

        return $job;
    }

}
