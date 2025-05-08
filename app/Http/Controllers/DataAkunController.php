<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class DataAkunController extends Controller
{
    public function index()
    {
        $customers = Akun::with(['role', 'alamat'])
            ->where('id_role', 2)
            ->get();

        return view('admin.data_akun.index', compact('customers'));
    }
}
