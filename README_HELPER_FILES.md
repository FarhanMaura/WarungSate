# 📦 File Helper untuk Hosting InfinityFree

File-file ini dibuat untuk memudahkan proses deployment aplikasi Laravel ke InfinityFree.

---

## 📋 Daftar File

### 1. `export-database.php` 
**Lokasi:** Lokal (`d:\TugasPropen\`)  
**Fungsi:** Export data dari SQLite ke format SQL yang kompatibel dengan MySQL

**Cara Pakai:**
```bash
php export-database.php
```

**Output:** File `database_export.sql` yang berisi semua data dari database lokal

**Kapan Digunakan:** Sebelum upload ke server, untuk export data lokal

---

### 2. `.env.production`
**Lokasi:** Lokal (`d:\TugasPropen\`)  
**Fungsi:** Template konfigurasi environment untuk production

**Cara Pakai:**
1. Edit file ini, ganti semua nilai yang bertanda `your_xxx` dengan info dari InfinityFree
2. Saat upload ke server, rename menjadi `.env` di folder `private_html/`

**Yang Harus Diganti:**
- `APP_URL` → URL website kamu
- `DB_HOST` → MySQL hostname dari InfinityFree
- `DB_DATABASE` → Nama database lengkap (epiz_xxxxx_warungsate)
- `DB_USERNAME` → Username MySQL
- `DB_PASSWORD` → Password MySQL
- `SESSION_DOMAIN` → Domain kamu (contoh: `.infinityfreeapp.com`)

---

### 3. `migrate-server.php`
**Lokasi:** Upload ke `htdocs/` dengan nama `migrate.php`  
**Fungsi:** Menjalankan migration Laravel di server via browser

**Cara Pakai:**
1. Upload file ini ke `htdocs/` dan rename menjadi `migrate.php`
2. Akses via browser: `https://your-domain.infinityfreeapp.com/migrate.php`
3. Tunggu sampai selesai
4. **HAPUS file ini setelah selesai!**

**Kapan Digunakan:** Setelah upload semua file, untuk membuat tabel database

---

### 4. `import-server.php`
**Lokasi:** Upload ke `htdocs/` dengan nama `import.php`  
**Fungsi:** Import data dari `database_export.sql` ke MySQL di server

**Cara Pakai:**
1. Pastikan file `database_export.sql` sudah diupload ke `private_html/`
2. Upload file ini ke `htdocs/` dan rename menjadi `import.php`
3. Akses via browser: `https://your-domain.infinityfreeapp.com/import.php`
4. Tunggu sampai selesai (bisa 1-5 menit)
5. **HAPUS file ini setelah selesai!**

**Kapan Digunakan:** Setelah migration selesai, untuk import data

---

### 5. `optimize-server.php`
**Lokasi:** Upload ke `htdocs/` dengan nama `optimize.php`  
**Fungsi:** Clear dan rebuild cache Laravel untuk performa optimal

**Cara Pakai:**
1. Upload file ini ke `htdocs/` dan rename menjadi `optimize.php`
2. Akses via browser: `https://your-domain.infinityfreeapp.com/optimize.php`
3. Tunggu sampai selesai
4. **HAPUS file ini setelah selesai!**

**Kapan Digunakan:** 
- Setelah import data selesai
- Setiap kali update file `.env`
- Setiap kali update routes atau config

---

## 🔄 Urutan Penggunaan

```
1. LOKAL: php export-database.php
   ↓
2. LOKAL: Edit .env.production
   ↓
3. UPLOAD: Semua file ke server
   ↓
4. SERVER: Akses migrate.php
   ↓
5. SERVER: Akses import.php
   ↓
6. SERVER: Akses optimize.php
   ↓
7. SERVER: Hapus semua file helper (migrate.php, import.php, optimize.php)
```

---

## ⚠️ PENTING!

### Keamanan
- **SELALU HAPUS** file helper dari server setelah digunakan!
- File-file ini bisa diakses siapa saja via browser
- Jangan biarkan file helper tetap ada di production

### File yang Harus Dihapus Setelah Deployment
- ✅ `htdocs/migrate.php`
- ✅ `htdocs/import.php`
- ✅ `htdocs/optimize.php`
- ✅ `private_html/database_export.sql`

### File yang Boleh Tetap Ada
- ✅ `export-database.php` (di lokal saja, jangan diupload)
- ✅ `.env.production` (di lokal saja, jangan diupload)

---

## 🐛 Troubleshooting

### Error saat menjalankan migrate.php
**Penyebab:**
- File `.env` tidak ada di `private_html/`
- Kredensial database salah
- Permission folder storage salah

**Solusi:**
1. Pastikan file `.env` ada di `private_html/`
2. Cek kredensial database di `.env`
3. Set permission `storage/` dan `bootstrap/cache/` = 777

---

### Error saat menjalankan import.php
**Penyebab:**
- File `database_export.sql` tidak ada
- Tabel belum dibuat (migration belum dijalankan)
- Format SQL tidak kompatibel

**Solusi:**
1. Pastikan file `database_export.sql` ada di `private_html/`
2. Jalankan `migrate.php` terlebih dahulu
3. Cek file SQL tidak corrupt

---

### Error saat menjalankan optimize.php
**Penyebab:**
- Permission folder cache salah
- File `.env` tidak valid

**Solusi:**
1. Set permission `bootstrap/cache/` = 777
2. Cek file `.env` format nya benar

---

## 📞 Bantuan

Jika masih ada masalah:
1. Cek error log di `private_html/storage/logs/laravel.log`
2. Cek error log InfinityFree di Control Panel → Error Logs
3. Baca panduan lengkap di `panduan_hosting_infinityfree.md`

---

**Selamat Hosting! 🚀**
