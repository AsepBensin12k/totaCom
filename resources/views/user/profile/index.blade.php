@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Profil Saya</h2>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Nama Lengkap</h3>
                        <p class="mt-1 text-gray-900">{{ $akun->nama }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Username</h3>
                        <p class="mt-1 text-gray-900">{{ $akun->username }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="mt-1 text-gray-900">{{ $akun->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Nomor Handphone</h3>
                        <p class="mt-1 text-gray-900">{{ $akun->no_hp ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                        <p class="mt-1 text-gray-900">
                            @if ($akun->alamat)
                                {{ $akun->alamat->detail_alamat }},
                                {{ $akun->alamat->kecamatan->nama_kecamatan ?? '-' }},
                                {{ $akun->alamat->kabupaten->nama_kabupaten ?? '-' }},
                                {{ $akun->alamat->provinsi->nama_provinsi ?? '-' }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <button onclick="openEditModal()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-900">Edit Profil</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <form action="{{ route('user.profile.update') }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $akun->nama) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $akun->username) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $akun->email) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $akun->no_hp) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="id_provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                        <select name="id_provinsi" id="id_provinsi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id_provinsi }}"
                                    {{ old('id_provinsi', optional($akun->alamat)->id_provinsi) == $provinsi->id_provinsi ? 'selected' : '' }}>
                                    {{ $provinsi->nama_provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="id_kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten</label>
                        <select name="id_kabupaten" id="id_kabupaten"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                    </div>

                    <div>
                        <label for="id_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="detail_alamat" class="block text-sm font-medium text-gray-700 mb-1">Detail
                            Alamat</label>
                        <textarea name="detail_alamat" id="detail_alamat" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('detail_alamat', optional($akun->alamat)->detail_alamat) }}</textarea>
                    </div>

                    <div>
                        <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-1">Password Baru
                            (opsional)</label>
                        <input type="password" id="password_baru" name="password_baru"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="password_baru_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" id="password_baru_confirmation" name="password_baru_confirmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Simpan Perubahan
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

        document.addEventListener('DOMContentLoaded', function() {
            const idProvinsi = document.getElementById('id_provinsi');
            const idKabupaten = document.getElementById('id_kabupaten');
            const idKecamatan = document.getElementById('id_kecamatan');

            idProvinsi.addEventListener('change', function() {
                fetch(`/api/kabupaten/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        idKabupaten.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                        data.forEach(item => {
                            idKabupaten.innerHTML +=
                                `<option value="${item.id_kabupaten}">${item.nama_kabupaten}</option>`;
                        });
                        idKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    });
            });

            idKabupaten.addEventListener('change', function() {
                fetch(`/api/kecamatan/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        idKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                        data.forEach(item => {
                            idKecamatan.innerHTML +=
                                `<option value="${item.id_kecamatan}">${item.nama_kecamatan}</option>`;
                        });
                    });
            });
        });
    </script>
@endsection
