<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Http\Responses\CVResponse;
use App\Models\Seeker;

class SeekerController extends Controller
{
    private $cvResponse;
    public function __construct(
        CVResponse $cvResponse,
    ) {
        $this->cvResponse = $cvResponse;
    }
    public function infoSeeker($id)
    {
        $seeker = Seeker::with(['curriculumVitaes'])->findOrFail($id);
        return response()->json($seeker);
    }
}
