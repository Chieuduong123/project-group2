<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Seeker;

class TestController extends Controller
{
    public function test()
    {
        dd(111);
        try {
            $business = auth()->user();
            $jobs = $business->jobs;

            return response()->json([
                'jobs' => $jobs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching job posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
