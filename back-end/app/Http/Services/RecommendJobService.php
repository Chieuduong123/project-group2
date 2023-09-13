<?php

namespace App\Http\Services;

use App\Http\Repositories\RecommendJobRepository;

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
}
