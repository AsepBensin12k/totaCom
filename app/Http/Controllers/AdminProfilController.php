<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfilController extends Controller
{
    public function index()
    {
        $akun = Auth::user();

        $akun->load(['alamat.provinsi', 'alamat.kabupaten', 'alamat.kecamatan']);

        $provinsis = Provinsi::where('nama_provinsi', 'LIKE', '%JAWA TIMUR%')
            ->select('id_provinsi', 'nama_provinsi')
            ->get();

        return view('admin.profile.index', compact('akun', 'provinsis'));
    }

    public function update(Request $request)
    {
        $akun = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:akuns,username,' . $akun->id_akun . ',id_akun',
            'email' => 'required|email|unique:akuns,email,' . $akun->id_akun . ',id_akun',
            'no_hp' => 'nullable|string|max:15',
            'password_baru' => 'nullable|min:6|confirmed',
            'id_provinsi' => 'required|exists:provinsis,id_provinsi',
            'id_kabupaten' => 'required|exists:kabupatens,id_kabupaten',
            'id_kecamatan' => 'required|exists:kecamatans,id_kecamatan',
            'detail_alamat' => 'required|string|max:500',
        ], [
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password_baru.min' => 'Password minimal 6 karakter',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok',
            'id_provinsi.required' => 'Provinsi harus dipilih',
            'id_provinsi.exists' => 'Provinsi yang dipilih tidak valid',
            'id_kabupaten.required' => 'Kabupaten harus dipilih',
            'id_kabupaten.exists' => 'Kabupaten yang dipilih tidak valid',
            'id_kecamatan.required' => 'Kecamatan harus dipilih',
            'id_kecamatan.exists' => 'Kecamatan yang dipilih tidak valid',
            'detail_alamat.required' => 'Detail alamat harus diisi',
        ]);

        $kabupaten = Kabupaten::where('id_kabupaten', $request->id_kabupaten)
            ->where('id_provinsi', $request->id_provinsi)
            ->first();

        if (!$kabupaten) {
            return back()->withErrors(['id_kabupaten' => 'Kabupaten tidak sesuai dengan provinsi yang dipilih'])
                ->withInput();
        }

        $kecamatan = Kecamatan::where('id_kecamatan', $request->id_kecamatan)
            ->where('id_kabupaten', $request->id_kabupaten)
            ->first();

        if (!$kecamatan) {
            return back()->withErrors(['id_kecamatan' => 'Kecamatan tidak sesuai dengan kabupaten yang dipilih'])
                ->withInput();
        }

        $akun->nama = $request->nama;
        $akun->username = $request->username;
        $akun->email = $request->email;
        $akun->no_hp = $request->no_hp;

        if ($request->filled('password_baru')) {
            $akun->password = Hash::make($request->password_baru);
        }

        if ($akun->alamat) {
            $akun->alamat->update([
                'id_provinsi' => $request->id_provinsi,
                'id_kabupaten' => $request->id_kabupaten,
                'id_kecamatan' => $request->id_kecamatan,
                'detail_alamat' => $request->detail_alamat,
            ]);
        } else {
            $alamat = Alamat::create([
                'id_provinsi' => $request->id_provinsi,
                'id_kabupaten' => $request->id_kabupaten,
                'id_kecamatan' => $request->id_kecamatan,
                'detail_alamat' => $request->detail_alamat,
            ]);

            $akun->id_alamat = $alamat->id_alamat;
        }

        $akun->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
