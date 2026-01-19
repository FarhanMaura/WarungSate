BAB 5
KESIMPULAN DAN SARAN

5.1 KESIMPULAN

Berdasarkan hasil perancangan, implementasi, dan pengujian yang telah dilakukan pada sistem informasi pemesanan menu di Warung Sate, maka dapat ditarik beberapa kesimpulan utama sebagai berikut:

1. Sistem aplikasi web Warung Sate telah berhasil dibangun dan diimplementasikan sesuai dengan kebutuhan pengguna, baik dari sisi administrasi maupun pelanggan. Aplikasi ini mampu menggantikan proses pencatatan pesanan manual menjadi sistem digital yang terintegrasi, mulai dari pemindaian QR Code hingga konfirmasi pembayaran.

2. Fitur-fitur utama yang dirancang, seperti manajemen menu (CRUD), validasi token meja berbasis QR Code, dan pelacakan status pesanan secara real-time, telah berfungsi dengan baik. Hasil pengujian black box menunjukkan bahwa seluruh skenario fungsional berjalan valid tanpa adanya kegagalan sistem yang kritikal.

3. Implementasi arsitektur MVC (Model-View-Controller) dengan framework Laravel terbukti efektif dalam memisahkan logika bisnis, antarmuka pengguna, dan pengelolaan data. Hal ini memudahkan proses pemeliharaan kode dan pengembangan fitur di masa mendatang.

4. Dari sisi pengalaman pengguna, antarmuka yang responsif memudahkan pelanggan untuk melakukan pemesanan melalui perangkat seluler tanpa perlu mengunduh aplikasi tambahan (web-based). Bagi admin, dashboard yang menyajikan ringkasan penjualan dan status pesanan aktif sangat membantu dalam meningkatkan efisiensi operasional warung.

5.2 SARAN

Meskipun sistem ini telah berjalan sesuai dengan tujuan awal penelitian, penulis menyadari masih terdapat ruang untuk perbaikan dan pengembangan lebih lanjut. Berikut adalah beberapa saran yang dapat dipertimbangkan untuk pengembangan sistem di masa mendatang:

1. Integrasi Payment Gateway Otomatis
Saat ini, sistem menggunakan validasi pembayaran manual melalui upload bukti transfer. Untuk ke depannya, disarankan untuk mengintegrasikan layanan payment gateway seperti Midtrans atau Xendit agar status pembayaran dapat terverifikasi secara otomatis dan real-time.

2. Penambahan Fitur Notifikasi Real-Time
Untuk meningkatkan responsivitas, sistem dapat dikembangkan dengan menambahkan fitur notifikasi push atau notifikasi via WhatsApp/Email kepada pelanggan saat status pesanan mereka berubah (misalnya: dari "Sedang Dimasak" menjadi "Siap Disajikan").

3. Pengembangan Modul Analitik Lanjutan
Fitur laporan saat ini masih bersifat deskriptif dasar. Pengembangan selanjutnya dapat menambahkan analisis prediktif, seperti prediksi menu terlaris berdasarkan tren waktu atau rekomendasi stok bahan baku, untuk membantu pemilik warung dalam pengambilan keputusan bisnis yang lebih strategis.

4. Ekspansi ke Platform Mobile (PWA/Native)
Meskipun versi web sudah responsif, pengembangan aplikasi ke arah Progressive Web App (PWA) atau aplikasi native (Android/iOS) dapat dipertimbangkan untuk memberikan akses yang lebih cepat dan fitur offline mode yang lebih baik bagi pengguna dengan koneksi internet yang tidak stabil.
