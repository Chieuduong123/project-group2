<?php

namespace App\Http\Repositories;

use App\Models\Experience;

class ExperienceRepository
{
    public function create(array $data)
    {
        return Experience::create($data);
    }

    public function update($cv, $data)
    {
        $cv->update([
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date'],
            'location' => $data['location'],
            'title' => $data['title'],
            'summary' => $data['summary'],
        ]);
    }

    public function find(int $id)
    {
        return Experience::find($id);
    }
}
