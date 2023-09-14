<?php

namespace App\Http\Repositories;

use App\Models\Job;

class JobRepository
{
    public function create(array $data)
    {
        return Job::create($data);
    }

    public function update($job, $data)
    {
        $job->update([
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

        ]);
    }
    public function find(int $id)
    {
        return Job::find($id);
    }
}
