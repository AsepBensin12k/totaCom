@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
    <div class="container mx-auto px-6 py-6">
        <div class="max-w-3xl mx-auto">
            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div id="success-alert"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-md relative"
                    role="alert">
                    <div class="flex justify-between items-center">
                        <p>{{ session('success') }}</p>
                        <button type="button" class="text-green-700 hover:text-green-900"
                            onclick="document.getElementById('success-alert').remove()">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                </div>

                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        if (alert) alert.remove();
                    }, 3000);
                </script>
            @endif

            {{-- Informasi Profil --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-blue-200 mb-6">
                <div class="bg-teal-600 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">Informasi Profil</h2>
                    <button onclick="openEditModal()"
                        class="bg-white text-teal-600 px-3 py-1 rounded text-sm font-medium hover:bg-blue-50 transition">
                        Edit Profil
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="mt-1 text-gray-900">{{ $akun->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Username</p>
                                <p class="mt-1 text-gray-900">{{ $akun->username }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-gray-900">{{ $akun->email }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Password</p>
                                <p class="mt-1 text-gray-900">••••••••</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nomor Handphone</p>
                                <p class="mt-1 text-gray-900">{{ $akun->no_hp ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat</p>
                                <p class="mt-1 text-gray-900">
                                    {{-- @if ($akun->alamat)
                                        {{ $akun->alamat }}
                                    @else
                                        -
                                    @endif --}}
                                    -
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- Edit Profile Modal --}}
    <div id="editProfileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-900">Edit Profil</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $akun->nama) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $akun->username) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $akun->email) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $akun->no_hp) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="col-span-1">
                        <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-1">Password Baru
                            (opsional)</label>
                        <div class="relative">
                            <input type="password" id="password_baru" name="password_baru"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password_baru') border-red-500 @enderror">
                        </div>
                        @error('password_baru')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="password_baru_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input type="password" id="password_baru_confirmation" name="password_baru_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $akun->alamat) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Contoh: Perumahan Tegal Besar Permai 1 Blok P, Kecamatan
                            Sumbersari, Kabupaten Jember, Jawa Timur</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none">
                        Perbarui Profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('editProfileModal');
            if (event.target === modal) {
                closeEditModal();
            }
        }
    </script>
@endsection
