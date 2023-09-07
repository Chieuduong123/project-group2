<?php

namespace App\Http\Controllers\CurriculumVitaes;

use App\Http\Controllers\Controller;
use App\Http\Responses\CVResponse;
use App\Http\Services\CreateCVService;
use App\Http\Services\DestroyCVService;
use App\Http\Services\UpdateCVService;
use App\Models\CurriculumVitae;
use Illuminate\Http\Request;

class CVController extends Controller
{
    private $cvResponse;

    public function __construct(
        CVResponse $cvResponse,
        CreateCVService $createCVService,
        UpdateCVService $updateCVService,
        DestroyCVService $destroyCVService
    ) {
        $this->cvResponse = $cvResponse;
        $this->createCVService = $createCVService;
        $this->updateCVService = $updateCVService;
        $this->destroyCVService = $destroyCVService;
    }

    public function getCV()
    {
        try {
            $seeker = auth()->user();
            $curriculumVitaes = CurriculumVitae::where('seeker_id', $seeker->id)
                ->with(['personalDetail', 'social', 'educations', 'experiences', 'languages'])
                ->get();

            $CVs = $curriculumVitaes->map(function ($curriculumVitae) {
                return $this->cvResponse->CVResponse($curriculumVitae);
            });

            return response()->json(['CV' => $CVs], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching CVs',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function getDetailCV($cvId)
    {
        try {
            $seeker = auth()->user();
            $curriculumVitae = CurriculumVitae::findOrFail($cvId);

            if ($curriculumVitae->seeker_id !== $seeker->id) {
                return response()->json([
                    'message' => 'You are not authorized to get this CV'
                ], 403);
            }

            $curriculumVitaes = CurriculumVitae::where('seeker_id', $seeker->id)
                ->where('id', $cvId)
                ->with(['personalDetail', 'social', 'educations', 'experiences', 'languages'])
                ->get();

            $CVs = $curriculumVitaes->map(function ($curriculumVitae) {
                return $this->cvResponse->CVResponse($curriculumVitae);
            });

            return response()->json(['CV' => $CVs], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching CVs',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $cvData = $request->all();
            $curriculumVitae = $this->createCVService->createCV($cvData);
            $response = [
                'CV' => $this->cvResponse->CVResponse($curriculumVitae)
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the CV',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $cvId)
    {
        try {
            $seeker = auth()->user();
            $curriculumVitae = CurriculumVitae::findOrFail($cvId);

            if ($curriculumVitae->seeker_id !== $seeker->id) {
                return response()->json([
                    'message' => 'You are not authorized to update this CV'
                ], 403);
            }

            $cvData = $request->all();
            $this->updateCVService->updateCV($curriculumVitae, $cvData);

            $response = [
                'CV' => $this->cvResponse->CVResponse($curriculumVitae),
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the CV',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($cvId)
    {
        // try {
        //     $seeker = auth()->user();
        //     $curriculumVitae = CurriculumVitae::findOrFail($cvId);

        //     if ($curriculumVitae->seeker_id !== $seeker->id) {
        //         return response()->json([
        //             'message' => 'You are not authorized to destroy this CV'
        //         ], 403);
        //     }

        //     $this->destroyCVService->destroyCV($curriculumVitae,);


        //     return response()->json(['message' => 'Delete CV successfull'], 201);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => 'An error occurred while updating the CV',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
    }
}
