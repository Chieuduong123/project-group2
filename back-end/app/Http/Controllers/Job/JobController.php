<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\Business;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function search(Request $request)
    {
        $query = Job::query();
        if ($request->has('position')) {
            $query->where('position', 'LIKE', '%' . $request->input('position') . '%');
        }
        if ($request->has('level')) {
            $query->where('level', 'LIKE', '%' . $request->input('level') . '%');
        }
        if ($request->has('location')) {
            $query->whereHas('business', function ($q) use ($request) {
                $q->where('location', 'LIKE', '%' . $request->input('location') . '%');
            });
        }

        $results = $query
            ->with('business')
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json($results);
    }

    public function getJobPosting()
    {
        $showJob = Job::with('business')
            ->where('status', true)
            ->get()
            ->makeHidden(['created_at', 'updated_at', 'status']);

        return response()->json($showJob);
    }


    public function getDetailJobPosting($id)
    {
        $job = Job::with('business')
            ->where('id', $id)
            ->first();

        return response()->json($job);
    }

    public function test()
    {
        dd(111);
    }
}
