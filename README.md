# Praktikum 9: PHP Modular (`Lab9Web`)

Aplikasi web PHP modular hasil refactoring dari proyek CRUD sebelumnya (`lab8_php_database`) menggunakan XAMPP (Apache & MySQL/MariaDB).

## Struktur Folder

- `index.php` — Entry point sekaligus router berbasis whitelist (`$routes`) dan fallback halaman `404`.
- `config/database.php` — Konfigurasi dan koneksi database MySQLi (`latihan1`).
- `helpers/functions.php` — Kumpulan fungsi bantuan (`e`, `formatRupiah`, `hitungDiskon`, `validasiEmail`, `ringkasTeks`).
- `views/` — Template layout bersama (`header.php`, `footer.php`) serta halaman statis/dashboard (`dashboard.php`, `home.php`, `about.php`, `kontak.php`, `404.php`).
- `modules/user/` — Modul CRUD data barang pada tabel `data_barang` (`list.php`, `add.php`, `edit.php`, `delete.php`).
- `assets/css/style.css` — Gaya tampilan halaman.
- `gambar/` — Penyimpanan file gambar barang yang diunggah.

## Cara Menjalankan

1. Pastikan **Apache** dan **MySQL** di XAMPP sudah aktif.
2. Pastikan database `latihan1` dan tabel `data_barang` sudah tersedia.
3. Akses aplikasi melalui browser:
   - Dashboard: `http://localhost/Lab9Web/index.php`
   - CRUD Data Barang: `http://localhost/Lab9Web/index.php?page=user/list`
   - Uji 404: `http://localhost/Lab9Web/index.php?page=tidak-ada`
   