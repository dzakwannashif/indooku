<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        return response()->json([
            'status' => true,
            'data' => 'data berhasil ditampilkan'
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'image' => 'image|memes:jpg,jpeg,png|max:2048',
            'password' => 'required',
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $input['password'] = Hash::make($input['password']);

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $input['image'] = $fileName;
        }

        $users = User::create($input);
        return response()->json([
            'status' => true,
            'data' => $users,
            'message' => 'data berhasil ditambahkan'
        ]);
    }
}
