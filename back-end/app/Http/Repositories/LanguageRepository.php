<?php

namespace App\Http\Repositories;

use App\Models\Language;

class LanguageRepository
{
    public function create(array $data)
    {
        return Language::create($data);
    }

    public function update($cv,  $data)
    {
        $cv->update([
            'name' => $data['name'],
            'level' => $data['level'],
        ]);
    }

    public function find(int $id)
    {
        return Language::find($id);
    }
}
