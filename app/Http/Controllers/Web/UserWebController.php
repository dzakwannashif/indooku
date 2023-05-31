<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserWebController extends Controller
{
    public function tampilanIndex()
    {
        $user = User::orderBy('name', 'asc')->get();
        return view('user.index', compact('user'));
    }

    public function tampilanEdit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'id tidak ditemukan'
            ]);
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads') . $fileName);
            $input['image'] = $fileName;
        }

        $user->syncRoles($input['roles']);
        $user->update($input);
        return redirect('/user');
    }
}
