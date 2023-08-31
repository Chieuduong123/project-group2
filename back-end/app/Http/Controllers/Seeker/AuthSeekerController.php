<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\SendEmailService;
use App\Models\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthSeekerController extends Controller
{
    public function register(RegisterRequest $request, SendEmailService $emailService)
    {
        $email = $request->email;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $seeker = Seeker::create($input);
        $success['token'] =  $seeker->createToken('JuongJob')->accessToken;

        $emailService->sendVerificationEmail($seeker->email);

        return response(['seeker' => $seeker, 'message' => 'Register successfully! Please check your Email or Spam your Email'], 201);
    }

    public function login(LoginRequest $request)
    {
        $seeker = Seeker::where('email', $request->email)->first();
        if ($seeker && Hash::check($request->password, $seeker->password)) {
            $success = $seeker->createToken('authToken')->accessToken;
            return response()->json(['message' => 'true', 'token' => $success, 'seeker' => $seeker]);
        } else {
            return response()->json(['message' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user('seeker')) {
            $request->user('seeker')->tokens()->delete();
        }
        return response()->json(['message' => 'You are logout']);
    }

    public function refreshToken()
    {
        $user = Auth::guard('seeker')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Token refreshed successfully',
            'token' => $token,
        ]);
    }
}
