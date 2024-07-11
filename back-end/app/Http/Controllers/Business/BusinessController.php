<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function searchBusiness(Request $request)
    {
        $query = Business::query();
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        $results = $query
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json($results);
    }
    public function getBusiness()
    {
        $business = Business::get();
        return response()->json($business);
    }

    public function getDetailBusiness($id)
    {
        $business = Business::withCount('jobs')->findOrFail($id);
        return response()->json($business);
    }
}
