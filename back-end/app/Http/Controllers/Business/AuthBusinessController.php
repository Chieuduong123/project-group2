<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\SendEmailService;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthBusinessController extends Controller
{
    public function register(Request $request, SendEmailService $emailService)
    {
        $email = $request->email;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $business = Business::create($input);
        $success['token'] =  $business->createToken('JuongJob')->accessToken;

        $emailService->sendVerificationEmail($business->email);

        return response(['business' => $business, 'message' => 'Register successfully! Please check your Email or Spam your Email'], 201);
    }

    public function login(LoginRequest $request)
    {
        $business = Business::where('email', $request->email)->first();
        if ($business && Hash::check($request->password, $business->password)) {
            $success = $business->createToken('authToken')->accessToken;
            return response()->json(['message' => 'true', 'token' => $success, 'business' => $business]);
        } else {
            return response()->json(['message' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user('business')) {
            $request->user('business')->tokens()->delete();
        }
        return response()->json(['message' => 'You are logout']);
    }
}
