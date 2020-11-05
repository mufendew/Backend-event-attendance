<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Organizer;

class AuthOrganizerController extends Controller
{

    public function __construct()
    {
      
    }
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = new Organizer;
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            return response()->json(['organizer' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'organizer Registration Failed!','email' => $request->input('email'), 'error' => $e], 409);
        }
    }
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::guard('organizer')->setTTL(540)->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token,Auth::guard('organizer')->user()->name);
    }
    public function logout()
    {
        auth('organizer')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token,$name)
    {
        return response()->json([
            'name' => $name,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('organizer')->factory()->getTTL() * 60
        ], 200);
    }
}
