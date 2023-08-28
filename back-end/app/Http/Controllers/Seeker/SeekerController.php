<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Seeker;

class SeekerController extends Controller
{
    public function infoSeeker()
    {
        $seeker = Seeker::get();
        return response()->json($seeker);
    }
}
