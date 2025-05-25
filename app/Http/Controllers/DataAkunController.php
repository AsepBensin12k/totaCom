<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class DataAkunController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $customers = Akun::with('role')
            ->where('id_role', 2);

        if ($query) {
            $customers = $customers->where(function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                    ->orWhere('username', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            });
        }

        $customers = $customers->get();

        return view('admin.data_akun.index', compact('customers'));
    }
}
