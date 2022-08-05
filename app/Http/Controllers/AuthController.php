<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ]
        );

        if($validator->fails()){
            $err = json_decode($validator->errors());
            return response()->json($err, 400);
        }

        $credentials = $request->only('username', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            throw new HttpException(403, 'Username or password wrong');
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'Bearer',
            ]
        ]);
    }

    public function register(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]
        );

        if($validator->fails()){
            $err = json_decode($validator->errors());
            return response()->json($err, 400);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'search_province' => $request->search_province ?? 0,
            'search_city' => $request->search_city ?? 0,
        ]);

        $token = Auth::login($user);
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'Bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'Bearer',
            ]
        ]);
    }
}
