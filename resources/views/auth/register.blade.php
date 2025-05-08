@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="/register" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Column 1 -->
            <div class="space-y-6">
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
            </div>

            <!-- Column 2 -->
            <div class="space-y-6">
                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-600">Provinsi</label>
                    <select name="provinsi" id="provinsi" required
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <option value="" {{ old('provinsi') ? '' : 'selected' }} class="text-gray-500">Pilih Provinsi
                        </option>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi->id_provinsi }}"
                                {{ old('provinsi') == $provinsi->id_provinsi ? 'selected' : '' }}>
                                {{ $provinsi->nama_provinsi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kabupaten" class="block text-sm font-medium text-gray-600">Kabupaten</label>
                    <select name="kabupaten" id="kabupaten" required
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <option value="" class="text-gray-500">Pilih Kabupaten</option>
                    </select>
                </div>

                <div>
                    <label for="kecamatan" class="block text-sm font-medium text-gray-600">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" required
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <option value="" class="text-gray-500">Pilih Kecamatan</option>
                    </select>
                </div>

                <div>
                    <label for="detail_alamat" class="block text-sm font-medium text-gray-600">Detail Alamat (No. Rumah / RT
                        / RW)</label>
                    <input type="text" name="detail_alamat" id="detail_alamat" required
                        placeholder="Contoh: Jl. Mawar No. 12 RT 03 RW 01"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Password dan Konfirmasi Password dalam 2 kolom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <div class="relative mt-2">
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="w-full p-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" id="togglePassword"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600">
                        <svg id="eyePassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                                0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Konfirmasi
                    Password</label>
                <div class="relative mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Konfirmasi Password" required
                        class="w-full p-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" id="togglePasswordConfirm"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600">
                        <svg id="eyePasswordConfirm" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                                0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>


        <div class="pt-4">
            <button type="submit"
                class="w-full md:w-1/2 mx-auto block bg-blue-500 text-white py-3 px-4 rounded-md hover:bg-blue-600 transition duration-200">Daftar</button>
        </div>
    </form>
@endsection

@section('footer-text')
    Sudah punya akun? <a href="/login" class="text-blue-500 hover:underline">Masuk di sini</a>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');

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

                    fetch(`/api/kabupaten/${provinsiId}`)
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Kabupaten data received:', data);

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

                            // Clear the dropdown
                            kecamatanSelect.innerHTML =
                                '<option value="" class="text-gray-500">Pilih Kecamatan</option>';

                            // Make sure data is array and not empty
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(kecamatan => {
                                    console.log(
                                        `Adding kecamatan: ${kecamatan.nama_kecamatan}, id: ${kecamatan.id}`
                                    );
                                    kecamatanSelect.innerHTML +=
                                        `<option value="${kecamatan.id}" class="text-gray-700">${kecamatan.nama_kecamatan}</option>`;
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


        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyePassword');
            const isVisible = input.type === 'text';
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
