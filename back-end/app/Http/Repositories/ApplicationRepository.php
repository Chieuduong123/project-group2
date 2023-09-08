<?php

namespace App\Http\Repositories;

use App\Models\Application;

class ApplicationRepository
{
    public function create($data)
    {
        return Application::create($data);
    }
}
