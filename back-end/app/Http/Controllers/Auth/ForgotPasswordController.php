<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {

        $seeker = Seeker::where('email', $request->email)->first();

        if (!$seeker) {
            return response()->json(["msg" => 'Seeker with this email address does not exist.'], 404);
        }

        $response = Password::broker('seekers')->sendResetLink(
            ['email' => $request->email]
        );

        if ($response === Password::RESET_LINK_SENT) {
            return response()->json(["msg" => 'Reset password link sent to your email.']);
        } else {
            return response()->json(["msg" => 'Unable to send reset password link.'], 500);
        }
    }
}
