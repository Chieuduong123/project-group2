<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;

class BusinessController extends Controller
{
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
