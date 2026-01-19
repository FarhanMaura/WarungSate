BAB 4 IMPEMENTASI DAN PENGUJIAN

4.1 GAMBARAN UMUM SISTEM (SYSTEM OVERVIEW)
Bagian ini memaparkan hasil pengembangan sistem Warung Sate yang telah selesai dibangun. Pengembangan sistem ini menghasilkan sebuah aplikasi berbasis web yang mampu menangani seluruh proses bisnis warung sate, mulai dari pengelolaan data master oleh admin hingga transaksi pemesanan mandiri oleh pelanggan. Implementasi sistem ini merupakan realisasi dari rancangan solusi untuk menjawab permasalahan operasional yang sebelumnya berjalan secara manual.

4.1.1 Pemecahan Masalah Operasional
Penerapan aplikasi Warung Sate telah berhasil memberikan solusi atas kendala-kendala manual yang teridentifikasi. Sistem digital yang dibangun menggantikan pencatatan kertas, sehingga risiko kesalahan pesanan dan kehilangan data transaksi dapat dieliminasi. Proses pelayanan menjadi lebih efisien karena pelanggan dapat langsung memesan melalui QR Code tanpa harus menunggu pelayan. Selain itu, ketersediaan laporan penjualan otomatis memudahkan pemilik dalam memantau performa bisnis secara akurat dan real-time.

4.1.2 Pencapaian Tujuan Implementasi
Hasil implementasi sistem telah memenuhi tujuan utama pengembangan, yaitu digitalisasi alur pemesanan dan pengelolaan warung. Sistem berhasil menyediakan platform yang terintegrasi di mana admin dapat mengelola menu dan meja dengan mudah, sementara pelanggan mendapatkan pengalaman pemesanan yang cepat dan mandiri. Fitur keamanan dan validasi yang diterapkan juga telah memastikan integritas data dan membatasi akses hanya kepada pihak yang berwenang.

4.1.3 Lingkup Fungsionalitas Sistem
Sistem yang dibangun mencakup serangkaian fitur yang dirancang untuk mendukung operasional warung. Lingkup fungsionalitas ini meliputi modul autentikasi dan otorisasi untuk keamanan akses, modul manajemen kontrol inventaris menu, modul manajemen meja digital dengan kode unik, serta modul transaksi pemesanan yang responsif. Seluruh fungsionalitas ini dijalankan di atas infrastruktur web yang stabil dan dapat diakses melalui berbagai perangkat.

[Tempat untuk menambahkan gambar Arsitektur Sistem - arsitektur_sistem.png]

4.2 PEMBAHASAN KEBUTUHAN SISTEM
Pada bagian ini dibahas mengenai realisasi kebutuhan sistem, baik dari aspek fungsional maupun non-fungsional, yang telah diterapkan dalam aplikasi Warung Sate. Pembahasan ini bertujuan untuk menguraikan bagaimana spesifikasi teknis diterjemahkan menjadi fitur-fitur nyata yang dapat digunakan oleh pengguna akhir.

4.2.1 Realisasi Fungsionalitas
Berdasarkan hasil pengujian fungsional, sistem telah berhasil mengakomodasi kebutuhan dua pengguna utama. Pada sisi Admin, fitur-fitur krusial seperti dashboard analitik, pengelolaan data menu (CRUD), dan verifikasi pesanan telah berjalan sesuai logika bisnis yang diharapkan. Pada sisi Pelanggan, alur pemesanan mulai dari scan QR Code, pemilihan menu, hingga konfirmasi pembayaran telah terimplementasi dengan lancar. Interaksi antar modul berjalan tanpa hambatan, membuktikan bahwa logika aplikasi telah terbangun dengan solid.

[Tempat untuk menambahkan gambar Activity Diagram Customer - activity_diagram_customer.png]
[Tempat untuk menambahkan gambar Activity Diagram Admin - activity_diagram_admin.png]

4.2.2 Realisasi Kualitas Sistem (Non-Fungsional)
Selain fitur utama, aspek kualitas sistem juga telah menjadi fokus utama dalam implementasi. Dari sisi keamanan, penerapan enkripsi bcrypt untuk password dan proteksi CSRF telah berjalan efektif melindungi data pengguna. Performa aplikasi terbukti optimal dengan waktu muat yang cepat berkat implementasi eager loading dan indeks database. Antarmuka pengguna (UI) yang dibangun menggunakan desain responsif juga telah berhasil memberikan pengalaman penggunaan yang konsisten baik pada layar desktop admin maupun layar smartphone pelanggan.

4.2.3 Diagram Use Case
Untuk memperjelas realisasi fungsionalitas yang telah dibahas, Diagram Use Case berikut menggambarkan interaksi lengkap antara pengguna (Admin dan Pelanggan) dengan fitur-fitur yang tersedia dalam sistem Warung Sate. Diagram ini memetakan batasan sistem dan hak akses masing-masing aktor.

[Tempat untuk menambahkan gambar Use Case Diagram - usecase.png]

4.3 DESIGN SYSTEM
Pada tahap ini, penulis merancang sistem secara visual dan struktural sebelum masuk ke tahap pengkodean. Design system mencakup perancangan antarmuka pengguna (User Interface) yang menjadi acuan tampilan aplikasi serta struktur basis data.

4.3.1 Desain Antarmuka Pengguna (UI/UX)
Desain antarmuka pengguna dirancang dengan pendekatan modern dan bersih untuk memudahkan interaksi. Untuk halaman Admin, digunakan layout dashboard dengan sidebar navigasi untuk akses cepat ke berbagai modul manajemen. Warna yang dominan adalah warna-warna yang sesuai dengan identitas kuliner sate (seperti oranye dan cokelat). Untuk tampilan Pelanggan, desain difokuskan pada pengalaman mobile (mobile-first), dengan kartu menu yang menampilkan gambar makanan secara menarik dan tombol aksi yang mudah dijangkau oleh ibu jari.

[Tempat untuk menambahkan gambar prototype UI - prototype_login.png, prototype_admin_dashboard.png, prototype_customer_menu.png]

4.4 IMPLEMENTASI
Tahap implementasi merupakan realisasi dari rancangan yang telah dibuat menjadi kode program yang dapat dijalankan. Pada tahap ini, penulis membangun basis data, logika sistem backend menggunakan framework Laravel, dan tampilan frontend menggunakan Blade template. Penulis menyusun kode program mengikuti standar arsitektur MVC (Model-View-Controller) untuk memastikan kode yang rapi dan terstruktur.

4.4.1 Pembuatan Struktur Database
Langkah pertama implementasi adalah pembuatan skema basis data. Penulis membuat tabel-tabel yang diperlukan seperti tabel users untuk menyimpan data admin, tabel menus untuk menyimpan informasi makanan dan minuman, tables untuk data meja dan QR Code, orders untuk mencatat transaksi pemesanan, dan order_items untuk rincian item dalam setiap pesanan. Relasi antar tabel didefinisikan dengan foreign key untuk menjaga integritas data.

[Tempat untuk menambahkan gambar ERD]

4.4.2 Implementasi Halaman Utama User View
Halaman utama pelanggan diimplementasikan agar dapat diakses setelah melakukan scan QR Code. Controller akan memvalidasi token meja dan menampilkan halaman yang berisi daftar menu. Pada halaman ini, penulis mengimplementasikan fitur filter kategori menu dan pencarian untuk memudahkan pelanggan menemukan menu yang diinginkan. Tampilan dibangun menggunakan HTML5 dan CSS3 murni untuk performa yang ringan.

[Tempat untuk kode implementasi Home Controller dan View]

4.4.3 Implementasi Fitur Login Admin
Fitur login admin dibangun memanfaatkan library autentikasi bawaan Laravel namun disesuaikan dengan kebutuhan tampilan. Halaman login dibuat sederhana dengan form input email dan password. Logic di belakang layar akan memverifikasi kredensial yang dimasukkan dengan data di tabel users. Jika cocok, sistem akan membuat sesi login dan mengarahkan admin ke halaman dashboard.

[Tempat untuk kode implementasi Auth Controller]

4.4.4 Implementasi Fungsi CRUD Menu, Meja, Metode Pembayaran, dan Pesanan
Modul manajemen menu diimplementasikan untuk memungkinkan admin mengubah isi daftar menu warung. Fitur ini mencakup form untuk input nama menu, harga, deskripsi, dan upload gambar produk. Penulis menggunakan fitur storage linking Laravel untuk menangani penyimpanan file gambar menu agar dapat diakses oleh publik. Validasi input juga diterapkan untuk mencegah data kosong atau format yang salah.

Selain menu, sistem juga memfasilitasi manajemen meja yang memungkinkan admin men-generate QR Code unik untuk setiap meja baru. Fitur manajemen metode pembayaran memberikan fleksibilitas bagi admin untuk menambahkan atau menonaktifkan rekening bank dan opsi pembayaran digital. Terakhir, manajemen pesanan (Order CRUD) menjadi pusat operasional di mana admin dapat memantau pesanan masuk secara real-time, mengubah status pesanan dari "pending" hingga "completed", serta memverifikasi bukti pembayaran.

[Tempat untuk kode implementasi Menu/Order Controller]

4.4.5 Implementasi Alur Pemesanan Pelanggan (Customer Flow)
Fitur pemesanan dari sisi pelanggan dirancang untuk kemudahan penggunaan tanpa perlu login. Implementasi dimulai dari validasi token QR Code meja, yang mengarahkan pelanggan ke halaman menu. Logika sistem mencakup penambahan item ke dalam session (keranjang belanja), kalkulasi total harga otomatis, hingga proses checkout yang menyimpan data pesanan ke database. Konfirmasi pesanan menampilkan ringkasan dan instruksi pembayaran sesuai metode yang dipilih.

[Tempat untuk kode implementasi CustomerController]

4.5 PENGUJIAN (TESTING)
Pengujian sistem dilakukan menggunakan metode Black Box Testing. Metode ini berfokus pada pengujian fungsionalitas fitu-fitur aplikasi untuk memastikan input yang diberikan menghasilkan output yang sesuai dengan rancangan. Pengujian dilakukan tanpa melihat logika kode internal, melainkan mensimulasikan aktivitas pengguna akhir (Admin dan Pelanggan).

4.5.1 Skenario Pengujian Unit (Unit Testing)
Sebelum melakukan pengujian antarmuka, dilakukan pengujian unit pada beberapa fungsi krusial di backend. Pengujian ini bertujuan memastikan logika perhitungan dan validasi data berjalan benar di level kode.

[Tempat untuk screenshot hasil PHPUnit / Terminal - pass_test.png]

4.5.2 Tabel Pengujian Fungsional (Black Box)
Berikut adalah hasil pengujian black box terhadap fitur-fitur utama sistem Warung Sate:

| No | Skenario Pengujian | Hasil yang Diharapkan | Hasil Pengujian | Kesimpulan |
|----|--------------------|-----------------------|-----------------|------------|
| 1 | Admin login dengan email/password salah | Sistem menolak akses dan menampilkan pesan error "Kredensial tidak cocok" | Muncul pesan error, tidak bisa masuk dashboard | Valid |
| 2 | Admin login dengan data benar | Sistem mengarahkan ke halaman Dashboard | Berhasil masuk ke Dashboard | Valid |
| 3 | Admin menambah menu baru dengan gambar | Data menu tersimpan di database dan gambar tampil | Menu bertambah di list, gambar muncul | Valid |
| 4 | Admin mengosongkan meja yang terisi | Status meja berubah menjadi "Tersedia" | Status berubah hijau (Tersedia) | Valid |
| 5 | Pelanggan scan QR meja | Masuk ke halaman menu dengan nomor meja yang sesuai | Halaman menu terbuka, nomor meja benar | Valid |
| 6 | Pelanggan checkout pesanan | Pesanan tersimpan dan muncul di dashboard admin sebagai "Pending" | Pesanan masuk di tab "Pending" admin | Valid |

Hasil pengujian di atas menunjukkan bahwa seluruh fitur utama telah berjalan sesuai skenario yang dirancang dan bebas dari error fungsional yang fatal.

4.6 EVALUASI
Tahap evaluasi dilakukan setelah aplikasi selesai dibangun dan diuji secara internal. Pada tahap ini, aplikasi diujicobakan kepada pengguna sebenarnya untuk mendapatkan umpan balik mengenai kegunaan dan pengalaman pengguna. Hasil evaluasi digunakan sebagai tolok ukur keberhasilan proyek dan dasar untuk pengembangan selanjutnya.

4.6.1 Uji Coba Oleh Pengguna (User Testing)
Uji coba lapangan dilakukan dengan melibatkan pemilik warung sebagai admin dan beberapa sukarelawan sebagai pelanggan. Pengguna diminta untuk menjalankan tugas-tugas spesifik seperti membuat pesanan baru, membayar pesanan, dan mengubah status pesanan. Selama uji coba, penulis mengamati interaksi pengguna dengan aplikasi dan mencatat kendala yang dihadapi. Secara umum, pengguna dapat menyelesaikan tugas tanpa bantuan, namun terdapat beberapa masukan terkait ukuran tombol pada tampilan mobile.

[Tempat untuk tabel hasil User Acceptance Test]

4.6.2 Analisis Kepuasan dan Kesesuaian Aplikasi
Analisis dilakukan berdasarkan feedback yang diterima dari hasil uji coba. Aplikasi dinilai telah memenuhi tujuan utama yaitu mendigitalisasi proses pemesanan dan pelaporan. Fitur scan QR Code dinilai sangat membantu mempercepat akses menu. Dari sisi admin, kemudahan rekap data penjualan menjadi nilai tambah utama. Meskipun demikian, terdapat ruang untuk peningkatan terutama pada variasi metode pembayaran digital yang terintegrasi langsung (payment gateway) yang saat ini masih bersifat manual konfirmasi.

[Tempat untuk grafik atau tabel kepuasan pengguna]
