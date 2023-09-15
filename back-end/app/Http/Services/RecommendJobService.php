<?php

namespace App\Http\Services;

use App\Http\Repositories\RecommendJobRepository;
use App\Models\Job;
use App\Models\RecommendJob;

class RecommendJobService
{
    private $recommendJobRepository;

    public function __construct(

        RecommendJobRepository $recommendJobRepository
    ) {

        $this->recommendJobRepository = $recommendJobRepository;
    }

    public function createRecommend(array $data)
    {
        $seeker = auth()->user();

        $recommendData = [
            'seeker_id' => $seeker->id,
            'position' => $data['position'],
            'type' => $data['type'],
            'level' => $data['level'],
            'salary' => $data['salary'],
            'skill' => $data['skill'],
            'location' => $data['location'],
        ];
        $recommend = $this->recommendJobRepository->create($recommendData);

        return $recommend;
    }

    public function updateRecommend($recommend, $data)
    {
        $this->recommendJobRepository->update($recommend, $data);

        return $recommend;
    }

    public function getRecommend($matchingJobs)
    {
        $seeker = auth()->user();
        $recommendJob = RecommendJob::where('seeker_id', $seeker->id)->first();

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
        return $matchingJobs;
    }
}
