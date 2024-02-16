<?php

namespace App\Http\Controllers;

use App\Contracts\PlatformUserInterface;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\PlatformUserResource;
use App\Mail\RegisterMailable;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    private PlatformUserInterface $platformUserInterface;
    public function __construct(PlatformUserInterface $platformUserInterface)
    {
        $this->platformUserInterface = $platformUserInterface;
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        $credential = $request->only(['email', 'password']);
        if (auth()->attempt($credential)) {
            $user = PlatformUser::find(auth()->user()->id);
            $token = $user->createToken('ems');
            return response()->json([
                'token' => $token->plainTextToken,
                'message' => 'Login successfully'
            ], 200);
        } else {
            return response()->json(['User name and password does not match.'], 401);
        }
    }

    public function logout()
    {
        try {
            $user = Auth::guard('api')->user();

            if ($user) {
                PersonalAccessToken::where('tokenable_id', $user->id)->delete(); // Revoke a specific token
            }
            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error logging out'], 500);
        }
    }


    public function verify()
    {
        return view('emails.verify');
    }
}
