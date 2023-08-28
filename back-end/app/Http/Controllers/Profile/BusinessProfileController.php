<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $business = $request->user('business')->makeHidden(['password']);

        return response()->json([
            'business' => $business
        ]);
    }

    public function updateProfile(Request $request)
    {
        $business = $request->user('business')->makeHidden(['password']);

        if ($request->hasFile('avatar')) {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $image = $request->file('avatar');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('avatars'), $filename);
            $business->avatar = $filename;
        }

        try {
            $business->save();

            return response()->json([
                'message' => 'business profile updated successfully',
                'business' => $business
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the business profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
