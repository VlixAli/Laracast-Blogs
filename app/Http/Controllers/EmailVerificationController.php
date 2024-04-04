<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/')->with('success', 'Email verified!');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent');
    }
}
