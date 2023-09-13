<?php

namespace App\Http\Repositories;

use App\Models\RecommendJob;

class RecommendJobRepository
{
    public function create(array $data)
    {
        return RecommendJob::create($data);
    }

    public function update($recommend, $data)
    {
        $recommend->update([
            'position' => $data['position'],
            'type' => $data['type'],
            'level' => $data['level'],
            'salary' => $data['salary'],
            'skill' => $data['skill'],
            'location' => $data['location'],
        ]);
    }
    public function find(int $id)
    {
        return RecommendJob::find($id);
    }
}
