<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::latets()->get();
        return response()->json([
            'status' => true,
            'data' => $role,
            'message' => 'data berhasil didapatkan'
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $role = Role::create($input);
        return response()->json([
            'status' => true,
            'data' => $role,
            'message' => 'role berhasil ditambahkan'
        ]);
    }
}
