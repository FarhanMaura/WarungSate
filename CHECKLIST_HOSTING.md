# ✅ CHECKLIST HOSTING INFINITYFREE
## Aplikasi: Warung Sate Madura Bukit Baru

---

## 📋 PERSIAPAN LOKAL

### 1. Install Dependencies
- [ ] Buka terminal di `d:\TugasPropen`
- [ ] Jalankan: `composer install --optimize-autoloader --no-dev`
- [ ] Jalankan: `npm install`
- [ ] Jalankan: `npm run build`
- [ ] Verifikasi folder `public/build/` sudah ada

### 2. Export Database
- [ ] Jalankan: `php export-database.php`
- [ ] Verifikasi file `database_export.sql` dibuat
- [ ] Cek ukuran file tidak 0 bytes
- [ ] Buka file dengan text editor, pastikan ada INSERT statements

### 3. Konfigurasi Production
- [ ] Buka file `.env.production`
- [ ] **JANGAN** edit dulu, tunggu dapat info dari InfinityFree
- [ ] Siapkan catatan untuk info database nanti

### 4. Verifikasi File
- [ ] Cek file `export-database.php` ada
- [ ] Cek file `.env.production` ada
- [ ] Cek file `migrate-server.php` ada
- [ ] Cek file `import-server.php` ada
- [ ] Cek file `optimize-server.php` ada
- [ ] Cek folder `public/build/` ada (hasil npm run build)

---

## 🌐 SETUP INFINITYFREE

### 1. Registrasi
- [ ] Buka https://infinityfree.net
- [ ] Klik "Sign Up"
- [ ] Isi form registrasi
- [ ] Verifikasi email
- [ ] Login ke dashboard

### 2. Buat Hosting Account
- [ ] Klik "Create Account"
- [ ] Pilih subdomain atau masukkan domain sendiri
- [ ] Tunggu account dibuat (1-5 menit)
- [ ] Catat info berikut:

```
FTP Hostname: _______________________
FTP Username: _______________________
FTP Password: _______________________
Website URL: ________________________
```

### 3. Buat Database MySQL
- [ ] Di Control Panel, klik "MySQL Databases"
- [ ] Klik "Create Database"
- [ ] Nama database: `warungsate`
- [ ] Tunggu database dibuat
- [ ] Catat info database:

```
MySQL Hostname: _______________________
MySQL Database: _______________________
MySQL Username: _______________________
MySQL Password: _______________________
```

### 4. Update File .env.production
- [ ] Buka file `.env.production` di lokal
- [ ] Ganti `APP_URL` dengan URL website kamu
- [ ] Ganti `DB_HOST` dengan MySQL Hostname
- [ ] Ganti `DB_DATABASE` dengan MySQL Database
- [ ] Ganti `DB_USERNAME` dengan MySQL Username
- [ ] Ganti `DB_PASSWORD` dengan MySQL Password
- [ ] Ganti `SESSION_DOMAIN` dengan domain kamu (contoh: `.infinityfreeapp.com`)
- [ ] Save file

---

## 📤 UPLOAD FILE

### 1. Install FTP Client
- [ ] Download FileZilla dari https://filezilla-project.org/
- [ ] Install FileZilla
- [ ] Buka FileZilla

### 2. Koneksi FTP
- [ ] Host: (FTP Hostname dari InfinityFree)
- [ ] Username: (FTP Username)
- [ ] Password: (FTP Password)
- [ ] Port: 21
- [ ] Klik "Quickconnect"
- [ ] Tunggu sampai connected

### 3. Upload ke `private_html/`

**Upload folder-folder berikut:**
- [ ] `app/`
- [ ] `bootstrap/`
- [ ] `config/`
- [ ] `database/`
- [ ] `resources/`
- [ ] `routes/`
- [ ] `storage/`
- [ ] `vendor/`

**Upload file-file berikut:**
- [ ] `artisan`
- [ ] `composer.json`
- [ ] `composer.lock`
- [ ] `database_export.sql`
- [ ] **RENAME** `.env.production` menjadi `.env` saat upload

**JANGAN upload:**
- ❌ `node_modules/`
- ❌ `.git/`
- ❌ `public/` (akan diupload ke htdocs)
- ❌ `.env` (gunakan .env.production yang sudah diedit)

### 4. Upload ke `htdocs/`

**Upload semua isi folder `public/`:**
- [ ] `.htaccess`
- [ ] `index.php`
- [ ] `favicon.ico`
- [ ] `robots.txt`
- [ ] `css/`
- [ ] `images/`
- [ ] `qrcodes/`
- [ ] `build/` (hasil npm run build)

**Upload file helper:**
- [ ] `migrate-server.php` (rename jadi `migrate.php`)
- [ ] `import-server.php` (rename jadi `import.php`)
- [ ] `optimize-server.php` (rename jadi `optimize.php`)

### 5. Edit index.php di Server
- [ ] Login ke Control Panel InfinityFree
- [ ] Klik "File Manager"
- [ ] Buka folder `htdocs/`
- [ ] Edit file `index.php`
- [ ] Cari baris: `require __DIR__.'/../vendor/autoload.php';`
- [ ] Ganti jadi: `require __DIR__.'/../private_html/vendor/autoload.php';`
- [ ] Cari baris: `$app = require_once __DIR__.'/../bootstrap/app.php';`
- [ ] Ganti jadi: `$app = require_once __DIR__.'/../private_html/bootstrap/app.php';`
- [ ] Save file

### 6. Set Permission Folder
Via File Manager, set permission (chmod) folder berikut ke **777**:

- [ ] `private_html/storage/`
- [ ] `private_html/storage/framework/`
- [ ] `private_html/storage/framework/cache/`
- [ ] `private_html/storage/framework/sessions/`
- [ ] `private_html/storage/framework/views/`
- [ ] `private_html/storage/logs/`
- [ ] `private_html/bootstrap/cache/`
- [ ] `htdocs/qrcodes/` (untuk QR code generation)
- [ ] `htdocs/images/` (untuk upload gambar)

**Cara set permission:**
1. Klik kanan folder
2. Pilih "Change Permissions" atau "Chmod"
3. Centang semua checkbox atau ketik 777
4. Klik OK

---

## 🗄️ SETUP DATABASE

### 1. Run Migration
- [ ] Buka browser
- [ ] Akses: `https://your-domain.infinityfreeapp.com/migrate.php`
- [ ] Tunggu proses selesai
- [ ] Pastikan muncul "✓ Migrations completed successfully!"
- [ ] Cek list tabel sudah dibuat

**Jika error:**
- Cek file `.env` di `private_html/` sudah ada
- Cek kredensial database di `.env` sudah benar
- Cek permission folder storage dan bootstrap/cache

### 2. Import Data
- [ ] Akses: `https://your-domain.infinityfreeapp.com/import.php`
- [ ] Tunggu proses import (bisa 1-5 menit)
- [ ] Pastikan muncul "✓ Import completed successfully!"
- [ ] Cek jumlah rows di setiap tabel

**Alternatif via phpMyAdmin:**
- [ ] Login ke phpMyAdmin dari Control Panel
- [ ] Pilih database kamu
- [ ] Klik tab "Import"
- [ ] Upload file `database_export.sql`
- [ ] Klik "Go"
- [ ] Tunggu sampai selesai

### 3. Verifikasi Data
- [ ] Login ke phpMyAdmin
- [ ] Pilih database kamu
- [ ] Cek tabel `users` ada data
- [ ] Cek tabel `menus` ada data
- [ ] Cek tabel `tables` ada data
- [ ] Cek tabel `payment_methods` ada data

---

## ⚡ OPTIMISASI

### 1. Run Optimize
- [ ] Akses: `https://your-domain.infinityfreeapp.com/optimize.php`
- [ ] Tunggu proses selesai
- [ ] Pastikan muncul "✓ Optimization completed successfully!"

### 2. Hapus File Helper (PENTING!)
Via File Manager, hapus file berikut dari `htdocs/`:
- [ ] `migrate.php`
- [ ] `import.php`
- [ ] `optimize.php`

Via File Manager, hapus file berikut dari `private_html/`:
- [ ] `database_export.sql`

---

## 🧪 TESTING

### 1. Test Halaman Utama
- [ ] Buka: `https://your-domain.infinityfreeapp.com`
- [ ] Pastikan redirect ke `/login`
- [ ] Tidak ada error 500 atau 404

### 2. Test Login Admin
- [ ] Login dengan kredensial admin kamu
- [ ] Pastikan berhasil login
- [ ] Redirect ke dashboard

### 3. Test Dashboard Admin
- [ ] Dashboard muncul dengan benar
- [ ] Statistik penjualan muncul
- [ ] Chart muncul
- [ ] Tidak ada error di console browser (F12)

### 4. Test Menu Management
- [ ] Klik menu "Menus"
- [ ] List menu muncul
- [ ] Gambar menu muncul
- [ ] Test tambah menu baru
- [ ] Test edit menu
- [ ] Test hapus menu

### 5. Test Table Management
- [ ] Klik menu "Tables"
- [ ] List meja muncul
- [ ] QR Code muncul
- [ ] Test tambah meja baru
- [ ] Test generate QR code
- [ ] Download QR code berhasil

### 6. Test Customer Order
- [ ] Copy UUID salah satu meja
- [ ] Buka: `https://your-domain.infinityfreeapp.com/order/{uuid}`
- [ ] Menu muncul dengan gambar
- [ ] Test tambah ke keranjang
- [ ] Test ubah quantity
- [ ] Test checkout
- [ ] Test pilih metode pembayaran
- [ ] Test submit order
- [ ] Pesanan masuk ke database

### 7. Test Order Management
- [ ] Login sebagai admin
- [ ] Klik menu "Orders"
- [ ] List pesanan muncul
- [ ] Test lihat detail pesanan
- [ ] Test update status pesanan
- [ ] Test verifikasi pembayaran

### 8. Test Print Struk
- [ ] Buka halaman customer dengan pesanan aktif
- [ ] Klik tombol "Cetak Struk"
- [ ] Print preview muncul dengan benar
- [ ] Format struk rapi

---

## 🔒 SECURITY CHECK

### 1. Environment
- [ ] File `.env` di `private_html/` tidak bisa diakses via browser
- [ ] Test akses: `https://your-domain.infinityfreeapp.com/../private_html/.env` (harus 403/404)

### 2. Debug Mode
- [ ] Buka file `.env` di server
- [ ] Pastikan `APP_DEBUG=false`
- [ ] Pastikan `APP_ENV=production`

### 3. File Helper
- [ ] Pastikan `migrate.php` sudah dihapus
- [ ] Pastikan `import.php` sudah dihapus
- [ ] Pastikan `optimize.php` sudah dihapus
- [ ] Pastikan `database_export.sql` sudah dihapus dari server

### 4. Permissions
- [ ] Folder `storage/` = 777
- [ ] Folder `bootstrap/cache/` = 777
- [ ] File `.env` = 644
- [ ] File `index.php` = 644

---

## 📊 MONITORING

### 1. Error Logs
- [ ] Cek `private_html/storage/logs/laravel.log`
- [ ] Tidak ada error critical
- [ ] Jika ada error, catat dan fix

### 2. Performance
- [ ] Website load dalam < 5 detik
- [ ] Gambar muncul dengan cepat
- [ ] Tidak ada broken images
- [ ] Tidak ada broken links

### 3. Browser Compatibility
- [ ] Test di Chrome
- [ ] Test di Firefox
- [ ] Test di Edge
- [ ] Test di Mobile browser

---

## 🎉 SELESAI!

Jika semua checklist sudah ✅, aplikasi kamu sudah live di InfinityFree!

**URL Aplikasi:** https://your-domain.infinityfreeapp.com

**Akses Admin:** https://your-domain.infinityfreeapp.com/login

**Akses Customer:** https://your-domain.infinityfreeapp.com/order/{uuid}

---

## 📝 CATATAN PENTING

1. **Backup Rutin:**
   - Backup database via phpMyAdmin setiap minggu
   - Download folder `storage/` untuk backup gambar

2. **Update Aplikasi:**
   - Jika ada perubahan code, upload file yang berubah saja
   - Setelah update, jalankan `optimize.php` lagi
   - Jangan lupa hapus `optimize.php` setelah selesai

3. **Troubleshooting:**
   - Jika error 500: cek `storage/logs/laravel.log`
   - Jika database error: cek kredensial di `.env`
   - Jika gambar tidak muncul: cek permission folder `images/`
   - Jika QR code tidak muncul: cek permission folder `qrcodes/`

4. **Limitations InfinityFree:**
   - Max file upload: 10MB
   - Max execution time: 60 detik
   - Tidak support cron jobs
   - Bandwidth terbatas

---

**Good Luck! 🚀**
