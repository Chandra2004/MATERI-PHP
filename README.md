# Dokumentasi Rekayasa Perangkat Lunak: Sistem Manajemen Rental PS

Dokumentasi ini menjelaskan pendekatan Rekayasa Perangkat Lunak (RPL) untuk pengembangan sistem manajemen rental PS secara digital. Sistem ini mencakup fitur login admin dan user, pemesanan billing game, pemesanan makanan, manajemen pesanan, kalkulasi harga, notifikasi real-time, dan manajemen stok makanan.

## 1. Use Case

Use case menggambarkan interaksi antara aktor (user, admin) dan sistem. Berikut adalah use case utama:

### Aktor
- **User**: Pengguna rental PS yang memesan billing game dan makanan.
- **Admin**: Pengelola rental PS yang melihat dan mengelola pesanan serta stok makanan.

### Use Case Diagram
```
[User] ---- (Login) ----> [Sistem]
   |---- (Pesan Billing Game) ----> [Sistem]
   |---- (Pesan Makanan) ----> [Sistem]
   |---- (Lihat Total Harga) ----> [Sistem]
   |---- (Logout) ----> [Sistem]

[Admin] ---- (Login) ----> [Sistem]
   |---- (Lihat Pesanan) ----> [Sistem]
   |---- (Terima Notifikasi) ----> [Sistem]
   |---- (Kelola Stok Makanan) ----> [Sistem]
   |---- (Logout) ----> [Sistem]
```

### Deskripsi Use Case

#### Login
- **Aktor**: User, Admin
- **Deskripsi**: Aktor memasukkan username, password, dan memilih role untuk mengakses sistem.
- **Pre-kondisi**: Aktor memiliki akun terdaftar.
- **Post-kondisi**: Aktor diarahkan ke dashboard sesuai role (user/admin).
- **Alur Utama**:
  1. Aktor memasukkan username, password, dan memilih role.
  2. Sistem memvalidasi kredensial.
  3. Sistem menampilkan dashboard (user: pemesanan; admin: daftar pesanan).
- **Alur Alternatif**: Jika kredensial salah, sistem menampilkan pesan error.

#### Pesan Billing Game
- **Aktor**: User
- **Deskripsi**: User memesan durasi waktu bermain PS.
- **Pre-kondisi**: User sudah login.
- **Post-kondisi**: Pesanan disimpan, harga dihitung, dan dapat dilihat admin.
- **Alur Utama**:
  1. User memasukkan durasi (jam).
  2. Sistem menghitung harga (misalnya, Rp10.000/jam).
  3. Sistem menyimpan pesanan.
  4. Sistem menampilkan konfirmasi.
- **Alur Alternatif**: Jika durasi tidak valid, sistem menampilkan pesan error.

#### Pesan Makanan
- **Aktor**: User
- **Deskripsi**: User memilih makanan dari daftar menu yang tersedia.
- **Pre-kondisi**: User sudah login, stok makanan tersedia.
- **Post-kondisi**: Pesanan disimpan, harga dihitung, dan dapat dilihat admin.
- **Alur Utama**:
  1. User memilih menu (misalnya, Nasi Goreng - Rp15.000).
  2. Sistem menghitung harga berdasarkan menu.
  3. Sistem menyimpan pesanan.
  4. Sistem menampilkan konfirmasi.
- **Alur Alternatif**: Jika menu tidak tersedia atau stok habis, sistem menampilkan pesan error.

#### Lihat Total Harga
- **Aktor**: User
- **Deskripsi**: User melihat total harga dari semua pesanan (billing game dan makanan).
- **Pre-kondisi**: User sudah login dan memiliki pesanan.
- **Post-kondisi**: Total harga ditampilkan.
- **Alur Utama**:
  1. User mengakses halaman total harga.
  2. Sistem menghitung total (billing game + makanan).
  3. Sistem menampilkan total harga.
- **Alur Alternatif**: Jika tidak ada pesanan, sistem menampilkan pesan "Belum ada pesanan".

#### Lihat Pesanan
- **Aktor**: Admin
- **Deskripsi**: Admin melihat daftar semua pesanan (game dan makanan).
- **Pre-kondisi**: Admin sudah login.
- **Post-kondisi**: Daftar pesanan ditampilkan.
- **Alur Utama**:
  1. Admin mengakses dashboard.
  2. Sistem menampilkan daftar pesanan dengan detail (jenis, deskripsi, waktu, harga).

#### Terima Notifikasi
- **Aktor**: Admin
- **Deskripsi**: Admin menerima notifikasi real-time saat ada pesanan baru.
- **Pre-kondisi**: Admin sudah login, sistem produksi menggunakan backend.
- **Post-kondisi**: Notifikasi ditampilkan di dashboard admin.
- **Alur Utama**:
  1. User membuat pesanan baru.
  2. Sistem mengirim notifikasi ke dashboard admin (via WebSocket untuk produksi).
  3. Admin melihat notifikasi.
- **Alur Alternatif**: Jika koneksi terputus, notifikasi ditampilkan saat koneksi pulih.

#### Kelola Stok Makanan
- **Aktor**: Admin
- **Deskripsi**: Admin menambah, mengedit, atau menghapus menu makanan.
- **Pre-kondisi**: Admin sudah login.
- **Post-kondisi**: Daftar menu diperbarui.
- **Alur Utama**:
  1. Admin mengakses halaman manajemen stok.
  2. Admin memilih aksi (tambah, edit, hapus).
  3. Sistem memperbarui daftar menu.
  4. Sistem menampilkan konfirmasi.
- **Alur Alternatif**: Jika input tidak valid (misalnya, harga negatif), sistem menampilkan pesan error.

#### Logout
- **Aktor**: User, Admin
- **Deskripsi**: Aktor keluar dari sistem.
- **Pre-kondisi**: Aktor sudah login.
- **Post-kondisi**: Aktor kembali ke halaman login.
- **Alur Utama**:
  1. Aktor menekan tombol logout.
  2. Sistem mengakhiri sesi dan menampilkan halaman login.

## 2. Software Development Life Cycle (SDLC)

Pendekatan SDLC yang digunakan adalah **Waterfall**, karena kebutuhan sistem sudah jelas dan proyek berskala kecil. Berikut adalah tahapan SDLC yang diperbarui:

### 1. Perencanaan
- **Tujuan**: Menentukan kebutuhan dan lingkup proyek.
- **Aktivitas**:
  - Mengidentifikasi aktor (user, admin) dan fitur (login, pemesanan, manajemen pesanan, kalkulasi harga, notifikasi, manajemen stok).
  - Menyusun kebutuhan fungsional (login, pemesanan, kalkulasi harga, notifikasi, manajemen stok) dan non-fungsional (responsif, aman, real-time untuk produksi).
  - Menentukan teknologi: HTML, JavaScript, Tailwind CSS untuk prototipe; Node.js, MySQL, WebSocket untuk produksi.
- **Output**: Dokumen kebutuhan, anggaran waktu (3 minggu untuk prototipe).

### 2. Analisis
- **Tujuan**: Merinci kebutuhan menjadi spesifikasi teknis.
- **Aktivitas**:
  - Membuat use case dan diagram untuk fitur baru (kalkulasi harga, notifikasi, manajemen stok).
  - Menentukan struktur data:
    - Pengguna: username, password, role.
    - Pesanan: jenis (game/makanan), detail, waktu, harga.
    - Menu makanan: nama, harga, stok.
  - Menyusun alur aplikasi: login → dashboard → pemesanan/kelola stok/logout.
- **Output**: Use case, spesifikasi teknis.

### 3. Desain
- **Tujuan**: Merancang arsitektur dan antarmuka sistem.
- **Aktivitas**:
  - Merancang antarmuka menggunakan Tailwind CSS (responsif, modern).
  - Merancang logika:
    - Prototipe: localStorage untuk data pengguna, pesanan, dan menu.
    - Produksi: Database MySQL dan WebSocket untuk notifikasi.
  - Membuat wireframe:
    - Halaman login: Form username, password, role.
    - Dashboard user: Form pemesanan game, makanan, dan tampilan total harga.
    - Dashboard admin: Tabel pesanan, notifikasi, dan form manajemen stok.
- **Output**: Wireframe, desain antarmuka, diagram alur data.

### 4. Implementasi
- **Tujuan**: Mengembangkan sistem berdasarkan desain.
- **Aktivitas**:
  - Membuat halaman web menggunakan HTML, JavaScript, Tailwind CSS.
  - Mengimplementasikan logika:
    - Login: Validasi kredensial dari localStorage.
    - Pemesanan: Simpan data ke localStorage, hitung harga.
    - Total harga: Hitung dan tampilkan total.
    - Admin: Tampilkan pesanan, kelola stok makanan.
    - Notifikasi: Simulasi notifikasi di prototipe (alert), WebSocket di produksi.
  - Menguji fungsionalitas di browser.
- **Output**: Kode aplikasi (index.html), prototipe fungsional.

### 5. Pengujian
- **Tujuan**: Memastikan sistem bebas bug dan sesuai kebutuhan.
- **Aktivitas**:
  - Pengujian unit: Uji login, pemesanan, kalkulasi harga, notifikasi, dan manajemen stok.
  - Pengujian integrasi: Pastikan alur login → pemesanan → total harga → logout berjalan.
  - Pengujian pengguna: Simulasi login sebagai user dan admin.
- **Output**: Laporan pengujian, bug yang diperbaiki.

### 6. Penerapan
- **Tujuan**: Menyebarkan sistem untuk penggunaan.
- **Aktivitas**:
  - Menyebarkan prototipe: File index.html diakses via browser.
  - Untuk produksi: Deploy ke server (misalnya, Vercel) dengan backend, database, dan WebSocket.
- **Output**: Sistem yang siap digunakan.

### 7. Pemeliharaan
- **Tujuan**: Menjaga sistem agar tetap relevan dan bebas bug.
- **Aktivitas**:
  - Memperbaiki bug yang dilaporkan.
  - Menambahkan fitur baru (misalnya, laporan penjualan, integrasi pembayaran).
  - Memperbarui teknologi (misalnya, versi Tailwind CSS, Node.js).
- **Output**: Sistem yang diperbarui.

## 3. Runtutan Proses Pengembangan

Berikut adalah alur pengembangan secara berurutan berdasarkan SDLC Waterfall:

### Hari 1-3: Perencanaan
- Diskusi dengan pemilik rental PS untuk mengkonfirmasi fitur baru.
- Menyusun dokumen kebutuhan (fungsional: login, pemesanan, kalkulasi harga, notifikasi, manajemen stok; non-fungsional: responsif, aman, real-time).
- Estimasi waktu: 3 minggu untuk prototipe.

### Hari 4-6: Analisis
- Membuat use case untuk fitur baru: kalkulasi harga, notifikasi, manajemen stok.
- Menentukan data: pengguna (username, password, role), pesanan (jenis, detail, waktu, harga), menu (nama, harga, stok).
- Menyusun alur aplikasi: login → dashboard → pemesanan/kelola stok/logout.

### Hari 7-9: Desain
- Membuat wireframe untuk halaman login, dashboard user (termasuk total harga), dan dashboard admin (termasuk manajemen stok).
- Merancang antarmuka responsif dengan Tailwind CSS.
- Menentukan penyimpanan: localStorage untuk prototipe, MySQL dan WebSocket untuk produksi.

### Hari 10-16: Implementasi
- Menulis kode HTML, JavaScript, dan Tailwind CSS.
- Mengimplementasikan fitur:
  - Login: Validasi kredensial.
  - Pemesanan game: Input durasi, hitung harga, simpan ke localStorage.
  - Pemesanan makanan: Pilih menu, hitung harga, simpan ke localStorage.
  - Total harga: Hitung dan tampilkan total.
  - Dashboard admin: Tampilkan pesanan, kelola stok, terima notifikasi (simulasi di prototipe).
- Menguji fungsionalitas di browser (Chrome, Firefox).

### Hari 17-19: Pengujian
- Menguji login dengan kredensial benar/salah.
- Menguji pemesanan game (durasi valid/tidak valid, harga benar).
- Menguji pemesanan makanan (menu dipilih/tidak tersedia, harga benar).
- Menguji kalkulasi total harga.
- Menguji manajemen stok (tambah/edit/hapus menu).
- Menguji notifikasi (simulasi di prototipe).
- Memperbaiki bug (misalnya, validasi input, perhitungan harga).

### Hari 20: Penerapan
- Menyediakan file index.html untuk prototipe.
- Memberikan instruksi: Buka file di browser, gunakan kredensial default (admin/admin123, user/user123).
- (Opsional untuk produksi) Deploy ke server dengan backend, database, dan WebSocket.

### Hari 21+: Pemeliharaan
- Mengumpulkan feedback dari pengguna.
- Merencanakan fitur tambahan (misalnya, laporan penjualan, integrasi pembayaran).
- Memperbarui dokumentasi jika ada perubahan.

## Catatan Tambahan
- **Prototipe**: Menggunakan localStorage untuk kemudahan pengembangan. Notifikasi disimulasikan dengan alert. Versi produksi memerlukan backend (Node.js), database (MySQL), dan WebSocket untuk notifikasi.
- **Skalabilitas**: Prototipe cocok untuk pengguna terbatas. Produksi membutuhkan server dan optimasi performa.
- **Keamanan**: Prototipe tidak menyimpan password dengan aman. Produksi harus menggunakan hashing (bcrypt) dan HTTPS.