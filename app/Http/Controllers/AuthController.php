<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Models\Akun;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        $login_type = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login' => 'Username/email atau password salah.',
        ]);
    }

    public function registerForm()
    {
        $provinsis = Provinsi::where('nama_provinsi', 'Jawa Timur')->get();
        return view('auth.register', compact('provinsis'));
    }


    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:akuns',
            'email' => 'required|email|unique:akuns',
            'password' => 'required|confirmed|min:6',
            'nama' => 'required',
            'no_hp' => 'required|unique:akuns',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
        ]);

        $akun = Akun::create([
            'username' => $request->username,
            'email' => $request->email,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'id_role' => 2,
            'id_alamat' => 1,
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
        ]);


        Auth::login($akun);
        return redirect('/dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
