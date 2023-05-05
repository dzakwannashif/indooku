<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function syncPermission(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'role id tidak ditemukan'
            ], 404);
        }

        $input = $request->all();

        $rules = [
            'permission.*' => 'required|exists:permissions,name'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $role->syncPermissions($input['permission']);
        return response()->json([
            'status' => true,
            'data' => $role,
            'message' => 'role berhasil di synchronize'
        ]);
    }
}
