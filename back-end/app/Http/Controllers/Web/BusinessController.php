<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Business;

class BusinessController extends Controller
{
    public function getBusiness()
    {
        $businesses = Business::paginate(12);
        return view('pages.list-company', compact('businesses'));
    }
}
