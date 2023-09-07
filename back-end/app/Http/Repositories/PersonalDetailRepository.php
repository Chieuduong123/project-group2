<?php

namespace App\Http\Repositories;

use App\Models\PersonalDetail;

class PersonalDetailRepository
{
    public function create(array $data)
    {
        return PersonalDetail::create($data);
    }

    public function update($cv, $data)
    {
        $cv->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'job_title' => $data['job_title'],
            'location' => $data['location'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'about_me' => $data['about_me'],
        ]);
    }

    public function destroy($data)
    {
        return $data->delete();
    }
    public function find(int $id)
    {
        return PersonalDetail::find($id);
    }
}
