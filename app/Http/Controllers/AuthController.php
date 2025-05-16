<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Akun;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $fieldType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->role) {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'login' => 'Akun Anda tidak memiliki role yang valid.'
                ]);
            }

            return $this->redirectToDashboard();
        }

        return back()->withErrors([
            'login' => 'Username/email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    protected function redirectToDashboard()
    {
        $user = Auth::user();

        switch ($user->role->role) {
            case 'admin':
                return redirect()->route('dashboard');
            case 'customer':
                return redirect()->route('user.dashboard');
            default:
                Auth::logout();
                return redirect('/login')->withErrors([
                    'login' => 'Role tidak dikenali.'
                ]);
        }
    }

    public function registerForm()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
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

        try {
            $alamat = Alamat::firstOrCreate([
                'id_provinsi' => $request->provinsi,
                'id_kabupaten' => $request->kabupaten,
                'id_kecamatan' => $request->kecamatan,
                'detail_alamat' => $request->detail_alamat,
            ]);

            $customerRole = Role::where('role', 'customer')->firstOrFail();

            $user = Akun::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'id_alamat' => $alamat->id_alamat,
                'id_role' => $customerRole->id_role,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
