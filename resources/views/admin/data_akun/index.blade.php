@extends('layouts.admin')

@section('title', 'Data Akun')

@section('content')
    <div class="container mx-auto px-4 py-4">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Data Akun Customer</h1>

        <div class="w-full overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full text-sm text-left text-gray-700 divide-y divide-gray-200">
                <thead class="bg-teal-500 text-white text-sm">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3">No.</th>
                        <th scope="col" class="px-4 sm:px-6 py-3">Nama</th>
                        <th scope="col" class="px-4 sm:px-6 py-3">Username</th>
                        <th scope="col" class="px-4 sm:px-6 py-3">Email</th>
                        <th scope="col" class="px-4 sm:px-6 py-3">No HP</th>
                        {{-- <th scope="col" class="px-4 sm:px-6 py-3">Alamat</th> --}}
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($customers as $index => $akun)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $akun->nama }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $akun->username }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $akun->email }}</td>
                            <td class="px-4 sm:px-6 py-3 whitespace-nowrap">{{ $akun->no_hp }}</td>
                            {{-- <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                                {{ $akun->alamat->detail ?? '-' }}
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data akun customer.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
