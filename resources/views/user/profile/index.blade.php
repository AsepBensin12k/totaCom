@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4 mt-24 mb-40">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-xl overflow-hidden border border-gray-200">
            <div class="bg-teal-600 px-6 py-4 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-white">Profil Saya</h2>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                        <h3 class="profile-detail-label">Nama Lengkap</h3>
                        <p class="profile-detail-value">{{ $akun->nama }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                        <h3 class="profile-detail-label">Username</h3>
                        <p class="profile-detail-value">{{ $akun->username }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                        <h3 class="profile-detail-label">Email</h3>
                        <p class="profile-detail-value">{{ $akun->email }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                        <h3 class="profile-detail-label">Nomor Handphone</h3>
                        <p class="profile-detail-value">{{ $akun->no_hp ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-md border border-gray-200">
                        <h3 class="profile-detail-label">Alamat</h3>
                        <p class="profile-detail-value">
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

                <div class="mt-4 flex justify-end">
                    <button onclick="openEditModal()"
                        class="bg-teal-600 text-white px-6 py-2 rounded-md hover:bg-teal-700 transition duration-200 shadow-lg">
                        Edit Profil
                    </button>
                </div>
            </div>
        </div>

        {{-- BAGIAN MODAL EDIT TIDAK BERUBAH DARI KODE ASLI ANDA --}}
        <div id="editProfileModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
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
                            <input type="text" id="username" name="username"
                                value="{{ old('username', $akun->username) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $akun->email) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Handphone</label>
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
            let currentProvinsiId = '{{ old('id_provinsi', optional($akun->alamat)->id_provinsi) }}';
            let currentKabupatenId = '{{ old('id_kabupaten', optional($akun->alamat)->id_kabupaten) }}';
            let currentKecamatanId = '{{ old('id_kecamatan', optional($akun->alamat)->id_kecamatan) }}';

            function openEditModal() {
                document.getElementById('editProfileModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                if (currentProvinsiId) {
                    loadKabupaten(currentProvinsiId, currentKabupatenId);
                }
            }

            function closeEditModal() {
                document.getElementById('editProfileModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            async function loadKabupaten(provinsiId, selectedKabupatenId = null) {
                try {
                    const kabupatenSelect = document.getElementById('id_kabupaten');
                    kabupatenSelect.innerHTML = '<option value="">Loading...</option>';

                    const response = await fetch(`/api/kabupaten/${provinsiId}`);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const kabupatenData = await response.json();

                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';

                    kabupatenData.forEach(item => {
                        const option = new Option(item.nama_kabupaten, item.id_kabupaten);
                        if (selectedKabupatenId && item.id_kabupaten == selectedKabupatenId) {
                            option.selected = true;
                        }
                        kabupatenSelect.add(option);
                    });

                    if (selectedKabupatenId) {
                        loadKecamatan(selectedKabupatenId, currentKecamatanId);
                    }
                } catch (error) {
                    console.error('Error loading kabupaten:', error);
                    const kabupatenSelect = document.getElementById('id_kabupaten');
                    kabupatenSelect.innerHTML = '<option value="">Error loading data</option>';
                }
            }

            async function loadKecamatan(kabupatenId, selectedKecamatanId = null) {
                try {
                    const kecamatanSelect = document.getElementById('id_kecamatan');
                    kecamatanSelect.innerHTML = '<option value="">Loading...</option>';

                    const response = await fetch(`/api/kecamatan/${kabupatenId}`);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const kecamatanData = await response.json();

                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

                    kecamatanData.forEach(item => {
                        const option = new Option(item.nama_kecamatan, item.id_kecamatan);
                        if (selectedKecamatanId && item.id_kecamatan == selectedKecamatanId) {
                            option.selected = true;
                        }
                        kecamatanSelect.add(option);
                    });
                } catch (error) {
                    console.error('Error loading kecamatan:', error);
                    const kecamatanSelect = document.getElementById('id_kecamatan');
                    kecamatanSelect.innerHTML = '<option value="">Error loading data</option>';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const idProvinsi = document.getElementById('id_provinsi');
                const idKabupaten = document.getElementById('id_kabupaten');
                const idKecamatan = document.getElementById('id_kecamatan');

                if (currentProvinsiId) {
                    loadKabupaten(currentProvinsiId, currentKabupatenId);
                }

                idProvinsi.addEventListener('change', function() {
                    const provinsiId = this.value;
                    idKabupaten.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                    idKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

                    if (provinsiId) {
                        loadKabupaten(provinsiId);
                    }
                });

                idKabupaten.addEventListener('change', function() {
                    const kabupatenId = this.value;
                    idKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

                    if (kabupatenId) {
                        loadKecamatan(kabupatenId);
                    }
                });
            });
        </script>
    @endsection
