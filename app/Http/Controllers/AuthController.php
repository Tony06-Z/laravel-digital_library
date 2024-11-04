<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    //Login Sistem
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($request->remember === "on") {
                setcookie("email", $request->email);
            } else {
                setcookie("email", "");
            }

            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin');
                    break;
                
                case 'petugas':
                    return redirect()->intended('/petugas');
                    break;

                case 'peminjam':
                    return redirect()->intended('/');
                    break;
            }

            return redirect()->route('login')->with('error', 'Login gagal, Pastikan username dan password benar');
        }
    }

    //Register Sistem
    public function register(Request $request)
    {
        try {
            $validateData = $request->validate([
                'username' => ['required','string','max:255','unique:users'],
                'password' => ['required','string','min:8'],
                'email' => ['required','string','email','max:255','unique:users'],
                'nama_lengkap' => ['required','string','max:255','unique:users'],
                'alamat' => ['required','string'],
            ]);

            $user = User::create([
                'username' => $validateData['username'],
                'password' => Hash::make($validateData['password']),
                'email' => $validateData['email'],
                'nama_lengkap' => $validateData['nama_lengkap'],
                'alamat' => $validateData['alamat'],
                'role' => 'peminjam',
            ]);

            return redirect('/login')->with('success', 'Registration successfull. Please login');
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
