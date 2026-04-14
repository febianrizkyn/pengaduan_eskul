# Sistem Pengaduan Siswa Ekstrakulikuler

Sistem pengaduan dan aspirasi siswa kepada organisasi ekstrakulikuler sekolah dengan struktur MVC (Model-View-Controller) menggunakan PHP OOP.

## 🚀 PROJECT PENGADUAN SISWA EXTRAKULIKULER 
[KLIK DISINI UNTUK LIHAT WEBSITE SAYA](https://pengaduanfebian.xo.je)

## Login Default

**Admin:**
- Username: `admin`
- Password: `123`

**Siswa:**
- Username: `siswa`
- Password: `123`

### Siswa
- Login menggunakan username dan password 
- Membuat pengaduan baru
- Melihat riwayat pengaduan
- Melihat status dan feedback pengaduan

### Admin
- Login dengan username dan password
- Dashboard statistik
- Kelola aspirasi (update status, berikan feedback)
- Kelola kategori pengaduan

### Ganti config

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

## Struktur Folder

```
pengaduan_eskul/
├── config/
│   ├── config.php          # Konfigurasi aplikasi
│   └── Database.php        # Class koneksi database (PDO)
├── controllers/
│   ├── Controller.php      # Base controller
│   ├── AuthController.php  # Login/Logout
│   ├── PengaduanController.php
│   ├── AdminController.php
│   └── KategoriController.php
├── models/
│   ├── Model.php           # Base model
│   ├── Admin.php
│   ├── Siswa.php
│   ├── Kategori.php
│   ├── Aspirasi.php
│   └── InputAspirasi.php
├── views/
│   ├── layouts/
│   │   ├── header.php
│   │   └── footer.php
│   ├── auth/
│   │   ├── login_siswa.php
│   │   └── login_admin.php
│   ├── pengaduan/
│   │   ├── index.php
│   │   ├── create.php
│   │   └── show.php
│   └── admin/
│       ├── dashboard.php
│       ├── aspirasi.php
│       ├── aspirasi_detail.php
│       └── kategori.php
├── database/
│   └── seeder.sql          # Data awal
├── index.php               # Entry point & router
└── .htaccess               # URL rewriting
```

## Instalasi

1. Pastikan XAMPP/Laragon sudah berjalan dengan Apache dan MySQL

2. Buat database baru:
   ```sql
   CREATE DATABASE db_pengaduan_eskul;
   ```

3. Import tabel dari phpMyAdmin atau jalankan seeder:
   ```sql
   SOURCE database/seeder.sql;
   ```

4. Sesuaikan konfigurasi database di `config/config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'db_pengaduan_eskul');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

5. Akses aplikasi:
   - Siswa: http://localhost/pengaduan_eskul/
   - Admin: http://localhost/pengaduan_eskul/?page=login-admin


## Teknologi

- PHP 7.4+
- MySQL / MariaDB
- Bootstrap 5.3
- Bootstrap Icons
- PDO untuk koneksi database

## Koneksi Database

Koneksi database menggunakan class `Database` dengan Singleton Pattern:

```php
// Cara penggunaan
$db = Database::getInstance()->getConnection();
```

Semua model mewarisi dari base `Model` yang otomatis menghandle koneksi database.
