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
    public function login(Request $request)
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

    public function register(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',

            'image' => 'image|mimes:jpeg,jpg,png|max:2048',

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

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $input['image'] = $fileName;
        } else {
            unset($input['image']);
        }

        // $credentials = $request->only(['name', 'email', 'password']);
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole('user');


        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'data' => $user,
            'token' => $token,
            'message' => 'Register berhasil'
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $userAuth = auth()->user();
        $user = User::find($userAuth->id);


        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move('uploads', $fileName);
            $input['image'] = $fileName;
        }
        $user->update($input);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil update',
            'data' => $user
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
