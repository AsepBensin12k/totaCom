@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <form method="POST" action="/register" class="space-y-6">
        @csrf
        <div>
            <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="no_hp" class="block text-sm font-medium text-gray-600">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" placeholder="Nomor HP" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Pilih Provinsi -->
        <div>
            <label for="provinsi" class="block text-sm font-medium text-gray-600">Provinsi</label>
            <select name="provinsi" id="provinsi" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="" {{ old('provinsi') ? '' : 'selected' }}>Pilih Provinsi</option>
                @foreach ($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}" {{ old('provinsi') == $provinsi->id ? 'selected' : '' }}>
                        {{ $provinsi->nama_provinsi }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Kabupaten -->
        <div>
            <label for="kabupaten" class="block text-sm font-medium text-gray-600">Kabupaten</label>
            <select name="kabupaten" id="kabupaten" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih Kabupaten</option>
            </select>
        </div>

        <!-- Pilih Kecamatan -->
        <div>
            <label for="kecamatan" class="block text-sm font-medium text-gray-600">Kecamatan</label>
            <select name="kecamatan" id="kecamatan" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih Kecamatan</option>
            </select>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-md hover:bg-blue-600 transition duration-200">Daftar</button>
        </div>
    </form>
@endsection

@section('footer-text')
    Sudah punya akun? <a href="/login" class="text-blue-500 hover:underline">Masuk di sini</a>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');

            async function loadKabupaten(provinsiId) {
                try {
                    const response = await fetch(`/api/kabupaten/${provinsiId}`);
                    const kabupatens = await response.json();
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    kabupatens.forEach(kabupaten => {
                        const option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.nama_kabupaten;
                        kabupatenSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Gagal memuat data kabupaten:', error);
                }
            }

            async function loadKecamatan(kabupatenId) {
                try {
                    const response = await fetch(`/api/kecamatan/${kabupatenId}`);
                    const kecamatans = await response.json();
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kecamatans.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.nama_kecamatan;
                        kecamatanSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Gagal memuat data kecamatan:', error);
                }
            }

            provinsiSelect.addEventListener('change', async function () {
                const provinsiId = this.value;
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                if (provinsiId) {
                    await loadKabupaten(provinsiId);
                }
            });

            kabupatenSelect.addEventListener('change', async function () {
                const kabupatenId = this.value;
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                if (kabupatenId) {
                    await loadKecamatan(kabupatenId);
                }
            });
        });
    </script>
@endsection
