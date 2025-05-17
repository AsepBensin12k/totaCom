<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{

    public function index()
    {
        $akun = Auth::user();
        return view('admin.profile.index', compact('akun'));
    }

    public function update(Request $request)
    {
        $akun = Auth::user();


        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:akuns,email,' . $akun->id_akun . ',id_akun',
            'no_hp' => 'nullable|string|max:15',
            'password_baru' => 'nullable|min:6|confirmed',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password_baru.min' => 'Password minimal 6 karakter',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $akun->nama = $request->nama;
        $akun->email = $request->email;
        $akun->no_hp = $request->no_hp;

        if ($request->filled('password_baru')) {
            $akun->password = Hash::make($request->password_baru);
        }

        $akun->save();

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
