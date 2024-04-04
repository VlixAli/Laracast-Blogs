<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('reset-password-sent')
            : back()->withErrors(['email' => __($status)]);
    }

    public function show()
    {
        return view('auth.reset-password-sent');
    }

    public function createResetPassword(string $token)
    {
        return view('auth.reset-password',[
            'token' => $token
        ]);
    }

    public function storeResetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password){
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successfully')
            : back()->withErrors(['email' => [__($status)]]);
    }


}
