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
        } else {
            $business->avatar = $request->old('avatar');
        }

        $business->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'website' => $request->website,
            'career' => $request->career,
            'size' => $request->size,
            'updated_at' => now(),
        ]);

        try {
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
