<?php

namespace App\Http\Controllers\Databases;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    public function giveRole(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'id user tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'role' => 'required|exists:roles,name'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $user->assignRole($request->input('role'));
        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'role berhasil di berikan'
        ]);
    }

    public function syncRole(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'id user not found'
            ]);
        }

        $input = $request->all();
        $rules = [
            'role' => 'required|exists:roles,name'
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        $user->syncRoles($input['role']);
        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'user berhasil melakukan sync dengan rolenya'
        ]);
    }
}
