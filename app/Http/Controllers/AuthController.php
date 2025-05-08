<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Akun;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role->role;

            // Arahkan sesuai dengan role
            if ($role == 'admin') {
                return redirect()->route('dashboard');
            } elseif ($role == 'customer') {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    public function registerForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $provinsis = Provinsi::select('id_provinsi', 'nama_provinsi')
            ->where('nama_provinsi', 'JAWA TIMUR')
            ->get();

        return view('auth.register', compact('provinsis'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:akuns,username',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:akuns,email',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'required|exists:provinsis,id_provinsi',
            'kabupaten' => 'required|exists:kabupatens,id_kabupaten',
            'kecamatan' => 'required|exists:kecamatans,id_kecamatan',
            'detail_alamat' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $alamat = Alamat::firstOrCreate([
            'id_provinsi' => $request->provinsi,
            'id_kabupaten' => $request->kabupaten,
            'id_kecamatan' => $request->kecamatan,
            'detail_alamat' => $request->detail_alamat,
        ]);

        $user = Akun::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'id_alamat' => $alamat->id_alamat,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
