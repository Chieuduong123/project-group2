<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Services\RecommendJobService;
use App\Models\RecommendJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecommendJobController extends Controller
{
    private $recommendJobService;
    public function __construct(
        RecommendJobService $recommendJobService
    ) {
        $this->recommendJobService = $recommendJobService;
    }

    public function getRecommend()
    {
        $seeker = auth()->user();
        $recommendJob = RecommendJob::where('seeker_id', $seeker->id)->get();
        return response()->json($recommendJob);
    }
    public function store(Request $request)
    {
        try {
            $seeker = auth()->user();

            $existingRecommendation = RecommendJob::where('seeker_id', $seeker->id)->first();
            if ($existingRecommendation) {
                return response()->json([
                    'message' => 'A recommendation already exists for this seeker',
                ], 400);
            }

            $recommendData = $request->all();
            $recommendJob = $this->recommendJobService->createRecommend($recommendData);

            return response()->json([
                'message' => 'Job recommend created successfully',
                'recommendJob' => $recommendJob
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while creating the recommend job',
            ], 500);
        }
    }

    public function update(Request $request, $recommendId)
    {
        try {
            $seeker = auth()->user();
            $recommendJob = RecommendJob::findOrFail($recommendId);

            if ($recommendJob->seeker_id !== $seeker->id) {
                return response()->json([
                    'message' => 'You are not authorized to update this recommend job'
                ], 403);
            }

            $recommendData = $request->all();
            $recommendJob = $this->recommendJobService->updateRecommend($recommendJob, $recommendData);

            return response()->json([
                'message' => 'Job recommend updated successfully',
                'recommendJob' => $recommendJob
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage() . '---Line: ' . $e->getLine());
            return response()->json([
                'message' => 'An error occurred while updating the recommend job',
            ], 500);
        }
    }
}
