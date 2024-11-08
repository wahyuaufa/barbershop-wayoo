<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Account;

class login extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)   // Mengirim error ke session
                ->withInput();
        }

        // Sanitasi input
        $user_name = trim($request->user_name); // Menghapus spasi di awal dan akhir
        $user_name = htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); // Escape special characters

        $passwordInput = $request->password;

        // Cek apakah pengguna ada di database
        $user = Account::where('user_name', $user_name)->first();
        $password = Account::where('password', $passwordInput)->first();
        // dd($password);
        // dd($user);

        if ($user) {

            if ($password) {
                Auth::login($user);

                return redirect()->route('random-names.index');
            } else {
                return redirect()->route('login')->with('failed', 'Invalid password');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Invalid credentials');
        }
    }
}
