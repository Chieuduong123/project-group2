<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Seeker;

class SeekerController extends Controller
{
    public function infoSeeker($id)
    {
        $seeker = Seeker::with(['curriculumVitaes'])->findOrFail($id);
        return response()->json($seeker);
    }
}
