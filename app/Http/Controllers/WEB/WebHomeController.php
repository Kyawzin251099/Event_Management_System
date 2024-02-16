<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\PlatformUser;
use Illuminate\Http\Request;

class WebHomeController extends Controller
{
    public function login(LoginRequest $request){
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

    public function register()
    {
        
    }
}
