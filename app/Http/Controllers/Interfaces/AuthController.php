<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        $input = $request->all();

        $rules = [
            'email' => 'required|email',
            //ditetapkan input dengan email format

            'password' => 'required|min:8',
            //ditetapkan minimal pass yaitu 8
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'data' => $user,
                'token' => $token,
                'message' => 'login berhasil'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'login gagal: email atau password tidak valid'
        ], 401);
    }

    public function registerUser(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',

            'email' => 'required|email|unique:users,email',
            //ditetapkan input dengan email format

            'password' => 'required|min:8',
            //ditetapkan minimal pass yaitu 8
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        // $credentials = $request->only(['name', 'email', 'password']);
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'data' => $user,
            'token' => $token,
            'message' => 'Register berhasil'
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $input = $request->all();

        $rules = [
            'email' => 'unique:users,email,' . $id
        ];


        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'user id tidak ditemukan'
            ]);
        }


        $user->update($input);

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'data' => $user,
            'token' => $token,
            'message' => 'data berhasil di update'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'anda berhasil logout'
        ]);
    }
}
