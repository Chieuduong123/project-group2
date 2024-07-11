<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\SendEmailService;
use App\Models\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('pages/login');
    }

    public function registerIndex()
    {
        return view('pages/register');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('web-seeker')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Invalid email or password']);
        }
    }

    public function register(RegisterRequest $request, SendEmailService $emailService)
    {
        $email = $request->email;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Seeker::create($input);

        auth()->guard('web-seeker')->login($user);
        $emailService->sendVerificationEmail($user->email);

        return redirect('v1/login');
    }

    public function logout(Request $request)
    {
        auth()->guard('web-seeker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
