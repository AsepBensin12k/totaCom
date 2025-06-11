@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
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
                <div class="bg-teal-500 px-6 py-4 flex justify-between items-center">
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
                                    @if ($akun->alamat)
                                        {{ $akun->alamat->detail_alamat }}, KECAMATAN
                                        {{ $akun->alamat->kecamatan->nama_kecamatan }},
                                        {{ $akun->alamat->kabupaten->nama_kabupaten }},
                                        {{ $akun->alamat->provinsi->nama_provinsi }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Profile Modal --}}
    <div id="editProfileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div
            class="relative top-10 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-900">Edit Profil</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                {{-- Informasi Dasar --}}
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Informasi Dasar</h4>
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
                            <input type="text" id="username" name="username"
                                value="{{ old('username', $akun->username) }}"
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
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Handphone</label>
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $akun->no_hp) }}"
                                placeholder="Contoh: 081234567890"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                {{-- Password Section --}}
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Ubah Password (Opsional)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-1">Password
                                Baru</label>
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
                    </div>
                </div>

                {{-- Alamat Section --}}
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Informasi Alamat</h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="id_provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi <span
                                    class="text-red-500">*</span></label>
                            <select id="id_provinsi" name="id_provinsi"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('id_provinsi') border-red-500 @enderror">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id_provinsi }}"
                                        {{ old('id_provinsi', $akun->alamat?->id_provinsi) == $provinsi->id_provinsi ? 'selected' : '' }}>
                                        {{ $provinsi->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten <span
                                    class="text-red-500">*</span></label>
                            <select id="id_kabupaten" name="id_kabupaten"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('id_kabupaten') border-red-500 @enderror">
                                <option value="">Pilih Kabupaten</option>
                            </select>
                            @error('id_kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan <span
                                    class="text-red-500">*</span></label>
                            <select id="id_kecamatan" name="id_kecamatan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('id_kecamatan') border-red-500 @enderror">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('id_kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="detail_alamat" class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat
                            <span class="text-red-500">*</span></label>
                        <textarea id="detail_alamat" name="detail_alamat" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('detail_alamat') border-red-500 @enderror"
                            placeholder="Contoh: Perumahan Tegal Besar Permai 1 Blok P, RT 01 RW 02">{{ old('detail_alamat', $akun->alamat?->detail_alamat) }}</textarea>
                        @error('detail_alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Masukkan detail alamat seperti nama jalan, nomor rumah,
                            RT/RW, dll.</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-500 hover:bg-teal-600 focus:outline-none transition duration-200">
                        Perbarui Profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentProvinsiId = '{{ old('id_provinsi', $akun->alamat?->id_provinsi) }}';
        let currentKabupatenId = '{{ old('id_kabupaten', $akun->alamat?->id_kabupaten) }}';
        let currentKecamatanId = '{{ old('id_kecamatan', $akun->alamat?->id_kecamatan) }}';


        console.log('Current IDs:', {
            provinsi: currentProvinsiId,
            kabupaten: currentKabupatenId,
            kecamatan: currentKecamatanId
        });


        function openEditModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';


            if (currentProvinsiId) {
                console.log('Loading kabupaten for provinsi:', currentProvinsiId);
                loadKabupaten(currentProvinsiId, currentKabupatenId);
            }
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

        document.addEventListener('DOMContentLoaded', function() {
            const provinsiSelect = document.getElementById('id_provinsi');
            const kabupatenSelect = document.getElementById('id_kabupaten');
            const kecamatanSelect = document.getElementById('id_kecamatan');

            if (provinsiSelect) {
                provinsiSelect.addEventListener('change', function() {
                    const provinsiId = this.value;

                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

                    if (provinsiId) {
                        loadKabupaten(provinsiId);
                    }
                });
            }

            if (kabupatenSelect) {
                kabupatenSelect.addEventListener('change', function() {
                    const kabupatenId = this.value;

                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

                    if (kabupatenId) {
                        loadKecamatan(kabupatenId);
                    }
                });
            }
        });

        async function loadKabupaten(provinsiId, selectedKabupatenId = null) {
            try {
                console.log('Loading kabupaten for provinsi ID:', provinsiId);

                // Tampilkan loading
                const kabupatenSelect = document.getElementById('id_kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Loading...</option>';

                const response = await fetch(`/api/kabupaten/${provinsiId}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const kabupatenData = await response.json();
                console.log('Kabupaten data received:', kabupatenData);

                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';

                if (Array.isArray(kabupatenData) && kabupatenData.length > 0) {

                    kabupatenData.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_kabupaten;
                        option.textContent = item.nama_kabupaten;
                        if (selectedKabupatenId && item.id_kabupaten == selectedKabupatenId) {
                            option.selected = true;
                        }
                        kabupatenSelect.appendChild(option);
                    });

                    if (selectedKabupatenId) {
                        console.log('Loading kecamatan for kabupaten:', selectedKabupatenId);
                        loadKecamatan(selectedKabupatenId, currentKecamatanId);
                    }
                } else {
                    kabupatenSelect.innerHTML = '<option value="">Tidak ada data kabupaten</option>';
                }

            } catch (error) {
                console.error('Error loading kabupaten:', error);
                const kabupatenSelect = document.getElementById('id_kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Error loading data</option>';
            }
        }

        async function loadKecamatan(kabupatenId, selectedKecamatanId = null) {
            try {
                console.log('Loading kecamatan for kabupaten ID:', kabupatenId);

                const kecamatanSelect = document.getElementById('id_kecamatan');
                kecamatanSelect.innerHTML = '<option value="">Loading...</option>';

                const response = await fetch(`/api/kecamatan/${kabupatenId}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const kecamatanData = await response.json();
                console.log('Kecamatan data received:', kecamatanData);

                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

                // Cek apakah data adalah array
                if (Array.isArray(kecamatanData) && kecamatanData.length > 0) {
                    // Isi dropdown dengan data kecamatan
                    kecamatanData.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_kecamatan;
                        option.textContent = item.nama_kecamatan;
                        if (selectedKecamatanId && item.id_kecamatan == selectedKecamatanId) {
                            option.selected = true;
                        }
                        kecamatanSelect.appendChild(option);
                    });
                } else {
                    kecamatanSelect.innerHTML = '<option value="">Tidak ada data kecamatan</option>';
                }

            } catch (error) {
                console.error('Error loading kecamatan:', error);
                const kecamatanSelect = document.getElementById('id_kecamatan');
                kecamatanSelect.innerHTML = '<option value="">Error loading data</option>';
            }
        }

        @if ($errors->any())
            setTimeout(() => {
                openEditModal();
            }, 100);
        @endif
    </script>
@endsection
