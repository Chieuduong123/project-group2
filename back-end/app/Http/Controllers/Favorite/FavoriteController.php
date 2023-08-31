<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Job;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function getFavoriteJobs()
    {
        $seeker = auth()->user();

        $favoriteJobs = Favorite::where('seeker_id', $seeker->id)
            ->with(['job.business'])
            ->get();

        return response()->json([
            'favorite_jobs' => $favoriteJobs
        ]);
    }
    public function addToFavorites(Request $request, $jobId)
    {
        $seeker = auth()->user();

        $existingFavorite = Favorite::where('seeker_id', $seeker->id)
            ->where('job_id', $jobId)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'You have already favorites for this job',
            ], 403);
        }
        $seeker = $request->user('seeker');
        $job = Job::findOrFail($jobId);

        $seeker->favoriteJobs()->syncWithoutDetaching([$job->id]);

        return response()->json([
            'message' => 'Job added to favorites'
        ]);
    }

    public function removeFromFavorites(Request $request, $jobId)
    {
        $seeker = $request->user('seeker');
        $seeker->favoriteJobs()->detach($jobId);

        return response()->json([
            'message' => 'Job removed from favorites'
        ]);
    }
}
