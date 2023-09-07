<?php

namespace App\Http\Repositories;

use App\Models\Social;

class SocialRepository
{
    public function create(array $data)
    {
        return Social::create($data);
    }

    public function update($cv, $data)
    {
        $cv->update([
            'github' => $data['github'],
            'instagram' => $data['instagram'],
            'facebook' => $data['facebook'],
            'linkendin' => $data['linkendin'],
            'telegram' => $data['telegram'],
            'twitter' => $data['twitter'],
            'web' => $data['web'],
        ]);
    }
    public function destroy($data)
    {
        return $data->delete();
    }
    public function find(int $id)
    {
        return Social::find($id);
    }
}
