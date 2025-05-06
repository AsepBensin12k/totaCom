<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $credentials = $request->only('email_or_username', 'password');

        $field = filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $validator = Validator::make($request->all(), [
            'email_or_username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt([$field => $credentials['email_or_username'], 'password' => $credentials['password']])) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email_or_username' => 'These credentials do not match our records.']);
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
