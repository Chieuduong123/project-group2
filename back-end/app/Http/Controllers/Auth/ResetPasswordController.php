<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::broker('seekers')->reset($credentials, function ($seeker, $password) {
            $seeker->password = bcrypt($password);
            $seeker->setRememberToken(Str::random(60));
            $seeker->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return view('auth.reset_password_fail');
        }

        return view('auth.reset_password_success');
    }
}
