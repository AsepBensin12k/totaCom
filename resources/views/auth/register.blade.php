@extends('layouts.register')

@section('title', 'Register')

@section('content')

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded-r-lg relative mb-6 animate-pulse">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <strong class="font-medium">Perhatian!</strong>
            </div>
            <ul class="list-disc list-inside mt-2 ml-7">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <!-- Grid Form dengan 3 kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom 1: Data Personal -->
            <div
                class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-teal-400 transform transition-all duration-300 hover:shadow-xl">
                <div class="mb-4">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-teal-800">Data Personal</h3>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="username" class="block text-sm font-medium text-teal-700 mb-2">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" required
                            class="w-full p-3 border-2 border-teal-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-teal-400 focus:border-teal-400 transition-all duration-300 bg-teal-50 hover:bg-white">
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-medium text-teal-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" required
                            class="w-full p-3 border-2 border-teal-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-teal-400 focus:border-teal-400 transition-all duration-300 bg-teal-50 hover:bg-white">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-teal-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" placeholder="nama@email.com" required
                            class="w-full p-3 border-2 border-teal-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-teal-400 focus:border-teal-400 transition-all duration-300 bg-teal-50 hover:bg-white">
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-teal-700 mb-2">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="08xxxxxxxxxx" required
                            class="w-full p-3 border-2 border-teal-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-teal-400 focus:border-teal-400 transition-all duration-300 bg-teal-50 hover:bg-white">
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Data Alamat -->
            <div
                class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-emerald-400 transform transition-all duration-300 hover:shadow-xl">
                <div class="mb-4">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-emerald-800">Data Alamat</h3>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-emerald-700 mb-2">Provinsi</label>
                        <select name="provinsi" id="provinsi" required
                            class="w-full p-3 border-2 border-emerald-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 bg-emerald-50 hover:bg-white text-gray-700">
                            <option value="" {{ old('provinsi') ? '' : 'selected' }} class="text-gray-500">Pilih
                                Provinsi</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id_provinsi }}"
                                    {{ old('provinsi') == $provinsi->id_provinsi ? 'selected' : '' }}>
                                    {{ $provinsi->nama_provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kabupaten" class="block text-sm font-medium text-emerald-700 mb-2">Kabupaten</label>
                        <select name="kabupaten" id="kabupaten" required
                            class="w-full p-3 border-2 border-emerald-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 bg-emerald-50 hover:bg-white text-gray-700">
                            <option value="" class="text-gray-500">Pilih Kabupaten</option>
                        </select>
                    </div>

                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-emerald-700 mb-2">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" required
                            class="w-full p-3 border-2 border-emerald-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 bg-emerald-50 hover:bg-white text-gray-700">
                            <option value="" class="text-gray-500">Pilih Kecamatan</option>
                        </select>
                    </div>

                    <div>
                        <label for="detail_alamat" class="block text-sm font-medium text-emerald-700 mb-2">Detail
                            Alamat</label>
                        <input type="text" name="detail_alamat" id="detail_alamat" required
                            placeholder="Contoh: Jl. Mawar No. 12 RT 03 RW 01"
                            class="w-full p-3 border-2 border-emerald-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 bg-emerald-50 hover:bg-white">
                    </div>
                </div>
            </div>

            <!-- Kolom 3: Data Keamanan -->
            <div
                class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-cyan-400 transform transition-all duration-300 hover:shadow-xl">
                <div class="mb-4">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-cyan-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m0 0v2m0-2h2m-2 0H10m4-8V9a4 4 0 00-8 0v2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18l-2 9H5l-2-9z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-cyan-800">Data Keamanan</h3>
                    </div>
                </div>

                <div class="space-y-5">
                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-cyan-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Masukkan password"
                                required
                                class="w-full p-3 pr-12 border-2 border-cyan-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-300 bg-cyan-50 hover:bg-white">
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-cyan-600 hover:text-cyan-800 transition-colors duration-200">
                                <svg id="eyePassword" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                                                                                                                                                                        9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                                                                                                                                                                                        0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="relative">
                        <label for="password_confirmation" class="block text-sm font-medium text-cyan-700 mb-2">Konfirmasi
                            Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Konfirmasi password" required
                                class="w-full p-3 pr-12 border-2 border-cyan-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-300 bg-cyan-50 hover:bg-white">
                            <button type="button" id="togglePasswordConfirm"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-cyan-600 hover:text-cyan-800 transition-colors duration-200">
                                <svg id="eyePasswordConfirm" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                                                                                                                                                                        9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                                                                                                                                                                                        0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-teal-500 to-emerald-600 text-white py-3 px-6 rounded-lg font-semibold text-lg shadow-lg hover:from-teal-600 hover:to-emerald-700 transform h transition-all duration-700 focus:outline-none focus:ring-1 focus:ring-teal-300">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                                Daftar Sekarang
                            </span>
                        </button>
                    </div>

                    <!-- Info keamanan -->
                    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 p-4 rounded-lg border border-teal-200">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-teal-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-teal-700">
                                <p class="font-medium mb-1">Tips Keamanan:</p>
                                <ul class="text-xs space-y-1">
                                    <li>• Gunakan minimal 8 karakter</li>
                                    <li>• Kombinasi huruf & angka</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer-text')
    Sudah punya akun? <a href="/login"
        class="text-teal-600 hover:text-teal-800 hover:underline font-medium transition-colors duration-200">Masuk di
        sini</a>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');

            // Animasi loading untuk select
            function showLoading(selectElement) {
                selectElement.innerHTML = '<option value="">Memuat...</option>';
                selectElement.classList.add('animate-pulse');
            }

            function hideLoading(selectElement) {
                selectElement.classList.remove('animate-pulse');
            }

            // Animasi input focus
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('transform', 'scale-105');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('transform', 'scale-105');
                });
            });

            function updateSelectStyle(selectElement) {
                if (selectElement.value === '') {
                    selectElement.classList.add('text-gray-500');
                } else {
                    selectElement.classList.remove('text-gray-500');
                    selectElement.classList.add('text-gray-700');
                }
            }

            provinsiSelect.addEventListener('change', function() {
                updateSelectStyle(this);

                const provinsiId = this.value;
                if (provinsiId) {
                    console.log(`Fetching kabupaten for provinsi ID: ${provinsiId}`);
                    showLoading(kabupatenSelect);

                    fetch(`/api/kabupaten/${provinsiId}`)
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Kabupaten data received:', data);
                            hideLoading(kabupatenSelect);

                            kabupatenSelect.innerHTML =
                                '<option value="" class="text-gray-500">Pilih Kabupaten</option>';

                            data.forEach(kabupaten => {
                                if (kabupaten.nama_kabupaten.toLowerCase().includes('jember')) {
                                    kabupatenSelect.innerHTML +=
                                        `<option value="${kabupaten.id_kabupaten}" class="text-gray-700">${kabupaten.nama_kabupaten}</option>`;
                                }
                            });

                            kabupatenSelect.disabled = false;
                            updateSelectStyle(kabupatenSelect);

                            // Jika hanya ada satu pilihan kabupaten (Jember), pilih secara otomatis
                            if (kabupatenSelect.options.length === 2) {
                                kabupatenSelect.selectedIndex = 1;
                                kabupatenSelect.dispatchEvent(new Event('change'));
                            }

                            // Reset kecamatan dropdown
                            kecamatanSelect.innerHTML =
                                '<option value="" class="text-gray-500">Pilih Kecamatan</option>';
                            kecamatanSelect.disabled = true;
                            updateSelectStyle(kecamatanSelect);
                        })
                        .catch(error => {
                            console.error('Error fetching kabupaten:', error);
                            hideLoading(kabupatenSelect);

                            kabupatenSelect.innerHTML =
                                '<option value="" class="text-gray-500">Error saat memuat data kabupaten</option>';
                        });
                } else {
                    kabupatenSelect.innerHTML =
                        '<option value="" class="text-gray-500">Pilih Kabupaten</option>';
                    kabupatenSelect.disabled = true;
                    updateSelectStyle(kabupatenSelect);

                    kecamatanSelect.innerHTML =
                        '<option value="" class="text-gray-500">Pilih Kecamatan</option>';
                    kecamatanSelect.disabled = true;
                    updateSelectStyle(kecamatanSelect);
                }
            });

            // Fungsi untuk mengambil data kecamatan berdasarkan kabupaten
            kabupatenSelect.addEventListener('change', function() {
                updateSelectStyle(this);

                const kabupatenId = this.value;
                console.log(`Kabupaten selected: ${kabupatenId}, value type: ${typeof kabupatenId}`);

                if (kabupatenId) {
                    console.log(`Fetching kecamatan for kabupaten ID: ${kabupatenId}`);
                    showLoading(kecamatanSelect);

                    // Enable kecamatanSelect jika kabupaten dipilih
                    kecamatanSelect.disabled = false;

                    fetch(`/api/kecamatan/${kabupatenId}`)
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Kecamatan data received:', data);
                            hideLoading(kecamatanSelect);

                            // Clear the dropdown
                            kecamatanSelect.innerHTML =
                                '<option value="" class="text-gray-500">Pilih Kecamatan</option>';

                            // Make sure data is array and not empty
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(kecamatan => {
                                    console.log(
                                        `Adding kecamatan: ${kecamatan.nama_kecamatan}, id: ${kecamatan.id_kecamatan}`
                                    );
                                    kecamatanSelect.innerHTML +=
                                        `<option value="${kecamatan.id_kecamatan}" class="text-gray-700">${kecamatan.nama_kecamatan}</option>`;
                                });

                                kecamatanSelect.disabled = false;
                                updateSelectStyle(kecamatanSelect);
                            } else {
                                console.warn('No kecamatan data received or invalid data format');
                                kecamatanSelect.innerHTML =
                                    '<option value="" class="text-gray-500">Tidak ada kecamatan tersedia</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching kecamatan:', error);
                            hideLoading(kecamatanSelect);
                            kecamatanSelect.innerHTML =
                                '<option value="" class="text-gray-500">Error saat memuat data kecamatan</option>';
                        });
                } else {
                    kecamatanSelect.innerHTML =
                        '<option value="" class="text-gray-500">Pilih Kecamatan</option>';
                    kecamatanSelect.disabled = true;
                    updateSelectStyle(kecamatanSelect);
                }
            });

            kecamatanSelect.addEventListener('change', function() {
                updateSelectStyle(this);
            });

            // Terapkan gaya saat halaman dimuat
            updateSelectStyle(provinsiSelect);
            updateSelectStyle(kabupatenSelect);
            updateSelectStyle(kecamatanSelect);

            // Trigger change event jika provinsi sudah dipilih saat halaman dimuat
            if (provinsiSelect.value) {
                provinsiSelect.dispatchEvent(new Event('change'));
            }
        });

        // Password toggle functionality dengan animasi
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyePassword');
            const isVisible = input.type === 'text';

            // Animasi button
            this.classList.add('transform', 'scale-90');
            setTimeout(() => {
                this.classList.remove('transform', 'scale-90');
            }, 150);

            input.type = isVisible ? 'password' : 'text';
            icon.innerHTML = isVisible ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 
                     9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 
                     0-8.268-2.943-9.542-7z" />` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                     a10.05 10.05 0 012.659-4.116M15 12a3 3 0 11-6 
                     0 3 3 0 016 0zm6 6l-18-18" />`;
        });

        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const input = document.getElementById('password_confirmation');
            const icon = document.getElementById('eyePasswordConfirm');
            const isVisible = input.type === 'text';

            // Animasi button
            this.classList.add('transform', 'scale-90');
            setTimeout(() => {
                this.classList.remove('transform', 'scale-90');
            }, 150);

            input.type = isVisible ? 'password' : 'text';
            icon.innerHTML = isVisible ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 
                     9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 
                     0-8.268-2.943-9.542-7z" />` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                     a10.05 10.05 0 012.659-4.116M15 12a3 3 0 11-6 
                     0 3 3 0 016 0zm6 6l-18-18" />`;
        });
    </script>
@endsection
