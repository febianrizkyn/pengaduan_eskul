# Sistem Pengaduan Siswa Ekstrakulikuler

Sistem pengaduan dan aspirasi siswa kepada organisasi ekstrakulikuler sekolah dengan struktur MVC (Model-View-Controller) menggunakan PHP OOP.

## 🚀 WEBSITE PENGADUAN EXTRAKULIKULER 
[Klik di sini untuk lihat web project saya](https://pengaduanfebian.xo.je)


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

```sql
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    no_hp VARCHAR(20),
    alamat VARCHAR(255)
);
```

```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_pengaduan_eskul');
define('DB_USER', 'root');
define('DB_PASS', '');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

```php
<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $no_hp  = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO contacts (nama, no_hp, alamat)
                         VALUES ('$nama', '$no_hp', '$alamat')");
}
?>

<h3>Tambah Kontak</h3>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama"><br><br>

    No HP:<br>
    <input type="text" name="no_hp"><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<hr>

<h3>Daftar Kontak</h3>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Alamat</th>
    </tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM contacts");
$no = 1;

while ($row = mysqli_fetch_assoc($data)) {
    echo "<tr>
            <td>$no</td>
            <td>{$row['nama']}</td>
            <td>{$row['no_hp']}</td>
            <td>{$row['alamat']}</td>
          </tr>";
    $no++;
}
?>

</table>
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

## Login Default

**Admin:**
- Username: `admin`
- Password: `123`

**Siswa:**
- Username: `siswa`
- Password: `123`

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
