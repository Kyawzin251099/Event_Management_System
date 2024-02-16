<?php

namespace App\Http\Controllers;

use App\Contracts\PlatformUserInterface;
use App\Mail\ResetPasswordMailable;
use App\Models\PasswordReset;
use App\Models\PlatformUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function __construct(private PlatformUserInterface $platformUserInterface)
    {
        $this->platformUserInterface = $platformUserInterface;
    }

    public function verify()
    {
        return view('password.verify');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
        ]);
        $token = Str::random(60);
        $timeZone = 'Asia/Yangon';
        $expiresAt = Carbon::now($timeZone)->addMinutes(30);
        $email = $validatedData['email'];
        $user = PlatformUser::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Your email doe not exist!'
            ], 401);
        }
        try {
            PasswordReset::create([
                'email' => $email,
                'token' => $token,
                'expires_at' => $expiresAt,
            ]);
            Mail::to($user->email)->send(new ResetPasswordMailable($user, $token));
            return response()->json([
                'message' => 'We have emailed your password reset link!'
            ], 200);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function showResetForm($token)
    {
        // Retrieve the user by token and verify the expiration
        $timeZone = 'Asia/Yangon';
        $passwordReset = PasswordReset::where('token', $token)
            ->where('expires_at', '>=', now($timeZone))
            ->first();

        if (!$passwordReset) {
            abort(404);
        }
        return view('password.reset');
    }

    public function reset(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
            'password' => 'required|confirmed|min:5|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{5,20}$/',
        ]);

        $email = $validatedData['email'];
        $user = PlatformUser::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Your email doe not exist!'
            ], 401);
        }
        $update_password = [];
        $update_password['password'] = Hash::make($validatedData['password']);
        $update_password = $this->platformUserInterface->update('PlatformUser', $update_password, $user->id);

        if (!$update_password) {
            return response()->json([
                'message' => 'Something went wrong and please try again!'
            ], 401);
        }
        return response()->json([
            'message' => 'Your password has been reset.'
        ], 200);
    }
}
