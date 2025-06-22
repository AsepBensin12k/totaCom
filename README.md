# 🌾 TotaCom - Sistem Informasi Manajemen Stok dan E-Commerce Toko Pertanian

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
</div>

<div align="center">
  <h3>🚀 Sistem Informasi Modern untuk Digitalisasi Toko Pertanian</h3>
  <p><em>Menjaga Eksistensi dan Optimalisasi Operasional Bisnis CV. Toko Pertanian Sumberdadi</em></p>
</div>

---

## 📋 Deskripsi Proyek

**TotaCom** adalah sistem informasi berbasis web yang dirancang khusus untuk membantu CV. Toko Pertanian Sumberdadi dalam mengelola stok dan transaksi penjualan secara digital. Sistem ini menggabungkan manajemen inventori dengan platform e-commerce yang terintegrasi.

### 🎯 Tujuan Utama
- **Digitalisasi Pencatatan**: Mengubah sistem pencatatan manual menjadi digital
- **Efisiensi Operasional**: Mengurangi waktu pencatatan dari 10-15 menit menjadi 5 menit
- **Minimalisasi Kesalahan**: Menurunkan tingkat kesalahan dari 5-10% menjadi 1-2%
- **Penghematan Biaya**: Mengurangi penggunaan nota kertas hingga 70%

---

## ✨ Fitur Utama

### 👨‍💼 **Panel Admin/Owner**
- 🔐 **Manajemen Akun**: Login, lihat/edit profil, logout
- 📦 **Manajemen Stok**: CRUD produk, pencarian produk real-time
- 📋 **Manajemen Pesanan**: Kelola pesanan, konfirmasi status, riwayat transaksi
- 📊 **Analisis Penjualan**: Grafik penjualan, laporan bulanan

### 🛒 **Panel Customer**
- 👤 **Akun Pelanggan**: Registrasi, login, kelola profil
- 🔍 **Katalog Produk**: Browse dan cari produk pertanian
- 🛍️ **Keranjang Belanja**: Tambah/kelola item keranjang
- 📦 **Pesanan**: Buat pesanan, tracking status, riwayat pembelian

---

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|----------|-----------|
| **Framework** | Laravel (PHP 8.3.16) |
| **Database** | MySQL + phpMyAdmin |
| **Frontend** | HTML5, CSS3, JavaScript, Bootstrap |
| **Environment** | Laragon (Windows) |
| **Dependency Manager** | Composer |
| **Architecture** | MVC Pattern |

---

## 📋 Persyaratan Sistem

### Minimum Requirements
- **PHP**: >= 8.3.16
- **MySQL**: >= 5.7
- **Composer**: Latest version
- **Web Server**: Apache/Nginx
- **Browser**: Chrome, Firefox, Safari (versi terbaru)
- **Koneksi Internet**: Stabil untuk operasional optimal

### Recommended Environment
- **Laragon** (untuk Windows)
- **XAMPP/MAMP** (alternatif)
- **RAM**: 4GB minimum, 8GB recommended
- **Storage**: 1GB free space

---

## 🚀 Instalasi dan Setup

### 1️⃣ Clone Repository

```bash
# Clone repository dari GitHub
git clone https://github.com/AsepBensin12k/totaCom.git

# Masuk ke direktori proyek
cd totaCom
```

### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies menggunakan Composer
composer install

# Jika terjadi error, coba update composer terlebih dahulu
composer self-update
composer install --no-dev --optimize-autoloader
```

### 3️⃣ Environment Configuration

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ Database Setup

1. **Buat Database MySQL**
```sql
CREATE DATABASE totacom_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. **Konfigurasi Environment (.env)**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=totacom_db
DB_USERNAME=root
DB_PASSWORD=

# SMTP Configuration (Optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

### 5️⃣ Database Migration & Seeding

```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder (jika tersedia)
php artisan db:seed

# Atau jalankan keduanya sekaligus
php artisan migrate --seed
```

### 6️⃣ Storage & Cache Setup

```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Clear dan optimize cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize untuk production (optional)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 7️⃣ Jalankan Aplikasi

```bash
# Development server
php artisan serve

# Atau dengan custom host dan port
php artisan serve --host=0.0.0.0 --port=8080
```

🎉 **Aplikasi siap digunakan di**: `http://localhost:8000`

---

## 🔧 Konfigurasi Tambahan

### SMTP Email Configuration
Untuk fitur notifikasi email, konfigurasikan SMTP di file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=totacom@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=totacom@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### File Upload Configuration
```bash
# Set permission untuk direktori storage (Linux/Mac)
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# Untuk Windows (melalui properties folder)
# Berikan full control pada folder storage dan bootstrap/cache
```

---

## 👥 Akun Default

### Admin/Owner Account
```
Email: admin@totacom.com
Password: admin123
Role: Owner
```

### Customer Test Account
```
Email: customer@totacom.com
Password: customer123
Role: Customer
```

*⚠️ **Penting**: Ganti password default setelah instalasi untuk keamanan!*

---

## 📊 Struktur Database

### Tabel Utama
- `users` - Data pengguna (admin & customer)
- `products` - Katalog produk pertanian
- `orders` - Data pesanan
- `order_items` - Detail item pesanan
- `carts` - Keranjang belanja
- `categories` - Kategori produk

### Relasi Database
```
users (1) → (n) orders
orders (1) → (n) order_items
products (1) → (n) order_items
users (1) → (n) carts
products (1) → (n) carts
```

---

## 🔄 Workflow Sistem

### Alur Pemesanan Customer
1. **Registrasi/Login** → Akses sistem
2. **Browse Produk** → Pilih produk pertanian
3. **Tambah ke Keranjang** → Kelola item
4. **Checkout** → Buat pesanan
5. **Pembayaran** → Online (Transfer) / Offline (Cash)
6. **Tracking** → Monitor status pesanan

### Status Pesanan
```
Dikemas → Dikirim → Selesai
    ↓
  Ditolak (jika pembayaran tidak valid)
```

---

## 🐛 Troubleshooting

### Problem Umum

**1. Composer Install Error**
```bash
# Update composer
composer self-update

# Install dengan flag ignore platform
composer install --ignore-platform-reqs

# Atau gunakan versi PHP yang sesuai
composer install --with-php-version=8.3
```

**2. Database Connection Error**
```bash
# Pastikan MySQL service running
# Cek konfigurasi di .env
# Test koneksi database
php artisan tinker
DB::connection()->getPdo();
```

**3. Permission Error (Linux/Mac)**
```bash
sudo chown -R $USER:www-data storage/
sudo chown -R $USER:www-data bootstrap/cache/
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

**4. Laravel Key Error**
```bash
php artisan key:generate
php artisan config:clear
```

---

## 📈 Monitoring & Maintenance

### Backup Rutin
```bash
# Backup database
mysqldump -u root -p totacom_db > backup_$(date +%Y%m%d).sql

# Backup files
tar -czf totacom_backup_$(date +%Y%m%d).tar.gz /path/to/totacom/
```

### Update Maintenance
- **Jadwal**: Setiap bulan pada pukul 23:00
- **Durasi**: Maksimal 30 menit
- **Aktivitas**: Update sistem, backup data, optimasi database

---

## 📞 Support & Kontribusi

### 🤝 Kontribusi
Kami menerima kontribusi untuk pengembangan TotaCom:

1. **Fork** repository ini
2. **Buat branch** untuk fitur baru (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Buat Pull Request**

### 📞 Kontak
- **Developer**: AsepBensin12k
- **GitHub**: [AsepBensin12k/totaCom](https://github.com/AsepBensin12k/totaCom)
- **Email**: support@totacom.com
- **Toko**: CV. Toko Pertanian Sumberdadi, Jl. Wolter Monginsidi No.89, Langsepam, Rowo Indah, Kec. Ajung, Kabupaten Jember, Jawa Timur 68175

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE) - lihat file LICENSE untuk detail lengkap.

---

## 🙏 Acknowledgments

- **CV. Toko Pertanian Sumberdadi** - Partner bisnis dan sponsor proyek
- **Universitas Jember** - Institusi pendukung
- **Laravel Community** - Framework dan dokumentasi
- **Tim B9** - Developer dan kontributor

---

<div align="center">
  <h3>🌾 Digitalisasi Pertanian untuk Masa Depan yang Lebih Baik 🌾</h3>
  <p>Dibuat dengan ❤️ oleh Tim B9 - UNEJ 2025</p>
  
  <p>
    <img src="https://img.shields.io/github/stars/AsepBensin12k/totaCom?style=social" alt="GitHub stars">
    <img src="https://img.shields.io/github/forks/AsepBensin12k/totaCom?style=social" alt="GitHub forks">
    <img src="https://img.shields.io/github/watchers/AsepBensin12k/totaCom?style=social" alt="GitHub watchers">
  </p>
</div>

---

*📝 **Catatan**: README ini akan terus diperbarui seiring dengan perkembangan proyek. Pastikan untuk selalu merujuk pada versi terbaru di repository.*
