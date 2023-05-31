<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthWebController extends Controller
{

    public function loginPage()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);


        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user->hasRole(['admin', 'karyawan'])) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
                // return dd('DISINI');
            } else {
                return redirect()->back()->with('error', 'anda tidak memiliki akses untuk masuk');
            }
        } else {
            return redirect()->back()->with('error', 'email atau password anda salah');
        }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('login.page');
    }
}
