<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::get();
        return response()->json([
            'status' => true,
            'data' => $permission,
            'message' => 'permission berhasil di panggil'
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

        $permission = Permission::create($input);
        return response()->json([
            'status' => true,
            'data' => $permission,
            'message' => 'permission berhasil di panggil'
        ]);
    }
}
