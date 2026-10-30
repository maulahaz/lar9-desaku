# Desaku — Web Manajemen Desa

Aplikasi web untuk mengelola data dan pelayanan administrasi desa (data penduduk, kelahiran,
kematian, perpindahan, keuangan, pengguna, dan konfigurasi situs) beserta halaman publik desa.

- Framework: Laravel 9 (PHP 8.1+)
- Database: MySQL
- Admin template: AdminLTE v3
- Frontend template: EduStage (ColorLib)

## Fitur

**Halaman publik**
- Beranda desa (profil, visi & misi, statistik, berita, kontak)
- Form hubungi kami yang tersimpan ke database

**Area pengelola (login)**
- Dashboard statistik
- Manajemen penduduk
- Data kelahiran, kematian, dan perpindahan
- Data keuangan desa (pemasukan/pengeluaran/saldo)
- Manajemen pengguna (tambah, edit, reset password, aktif/non-aktif)
- Profil, upload foto, dan ganti password
- Konfigurasi situs (nama desa, logo, alamat, kontak, sosial media)

## Kebutuhan

- PHP 8.1 atau lebih baru (ekstensi `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`)
- Composer 2
- MySQL 5.7+/8.x
- Node.js & NPM (opsional, hanya jika ingin mengubah aset frontend)

## Instalasi

1. Install dependency PHP:

   ```bash
   composer install
   ```

2. Siapkan file environment:

   ```bash
   copy .env.example .env   # Windows
   # cp .env.example .env   # Linux/macOS
   php artisan key:generate
   ```

3. Buat database MySQL, misalnya `desaku_db`, lalu sesuaikan `.env`:

   ```env
   DB_DATABASE=desaku_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Import struktur & data awal (tabel lama `tbl_pengguna`, `tbl_penduduk`, `tbl_berita`, dll):

   ```bash
   mysql -u root desaku_db < database/db-desaku.sql
   ```

5. Jalankan migrasi tabel aplikasi (penduduks, kelahirans, kematians, perpindahans,
   keuangans, configs, roles):

   ```bash
   php artisan migrate
   ```

6. (Opsional) Isi data contoh untuk modul baru, konfigurasi situs, dan akun demo:

   ```bash
   php artisan db:seed
   ```

   > Ingin hanya menyiapkan akun demo? Jalankan `php artisan db:seed --class=UserSeeder`.
   > Jika konfigurasi situs kosong, jalankan `php artisan db:seed --class=ConfigSeeder`.

7. Jalankan server:

   ```bash
   php artisan serve
   ```

   Buka <http://127.0.0.1:8000>.

## Akun Demo

Semua akun menggunakan password: `pass123`

| User ID     | Role          |
|-------------|---------------|
| `admindesa` | Administrator |
| `pengelola` | Supervisor    |
| `staff_1`   | Staf          |
| `user_1`    | Warga         |

Akun demo dibuat/diperbarui oleh `php artisan db:seed` (kelas `UserSeeder`). Pengguna baru juga
dapat mendaftar melalui halaman `/register` (role Warga).

## Struktur Singkat

- `app/Http/Controllers/Admin` — modul pengelolaan data
- `app/Http/Controllers/Auth` — login, daftar, logout
- `app/Http/Controllers/HomeController.php` — halaman publik desa
- `app/Models/User.php` — model pengguna (tabel `tbl_pengguna`)
- `resources/views/templates/adminlte` — layout area pengelola
- `resources/views/templates/edustage` — layout halaman publik
- `database/db-desaku.sql` — dump database awal

## Catatan

- Password tersimpan dalam bentuk hash bcrypt.
- Penghapusan pengguna dilakukan secara *soft delete* (kolom `is_delete = 'Y'`) agar data
  riwayat tetap aman.
- Untuk mereset password pengguna, gunakan menu **Pengguna → Reset Password** di area admin.
