<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Seeker;
use Illuminate\Http\Request;

class SeekerProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $seeker = $request->user('seeker')->makeHidden(['password']);

        return response()->json([
            'seeker' => $seeker
        ]);
    }

    public function updateProfile(Request $request)
    {
        $seeker = $request->user('seeker')->makeHidden(['password']);

        if ($request->hasFile('avatar')) {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $image = $request->file('avatar');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('avatars'), $filename);
            $seeker->avatar = $filename;
        }

        try {
            $seeker->save();

            return response()->json([
                'message' => 'Seeker profile updated successfully',
                'seeker' => $seeker
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the seeker profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
