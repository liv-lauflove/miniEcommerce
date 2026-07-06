# Mini E-Commerce Project (UAS Rekayasa Perangkat Lunak)

## 📌 Deskripsi Sistem
Proyek ini adalah sistem Mini E-commerce (Minimum Viable Product) yang dibangun dengan Framework Laravel. Aplikasi ini memungkinkan pengguna untuk melihat katalog produk, menambah barang ke keranjang, dan melakukan *checkout* (pembelian) dengan beberapa pilihan metode pembayaran. Admin dapat mengelola pesanan dan memperbarui status pesanan.

### Fitur Utama:
- Katalog Produk & Kategori
- Keranjang Belanja (Cart)
- Checkout dengan perhitungan jarak (delivery radius)
- Riwayat Pesanan (Order History)
- Manajemen Status Pesanan (Admin)

### Instruksi Menjalankan Aplikasi Secara Lokal
1. Clone repositori ini.
2. Buka terminal dan jalankan perintah `composer install`.
3. Salin `.env.example` menjadi `.env` lalu konfigurasi database Anda.
4. Jalankan perintah `php artisan key:generate`.
5. Jalankan migrasi dan seeder dengan `php artisan migrate --seed` (jika ada).
6. Jalankan server pengembangan menggunakan `php artisan serve`.
7. Aplikasi siap diakses melalui `http://localhost:8000`.

---

## 🏛️ Penjelasan Arsitektur
Proyek ini menggunakan **Layered Architecture / Clean Architecture** dengan memisahkan kode menjadi lapisan-lapisan berikut:
- **Presentation Layer (Handler/UI)**: Berisi HTTP Controllers yang menerima request dan mengembalikan response (berada di `app/Http/Services/`).
- **Business/Application Logic (Service/Usecase)**: Berisi aturan bisnis inti aplikasi, seperti `DistanceService` (`app/Services/DistanceService.php`) dan implementasi-implementasi *Design Pattern* terisolasi.
- **Infrastructure/Data Access Layer (Repository/Database)**: Menggunakan standar Data Access/ORM (Eloquent) untuk interaksi tabel pada layer infrastruktur.

---

## 🧩 Daftar Design Pattern yang Diterapkan

Sistem ini mengimplementasikan 2 (dua) buah Design Pattern dari rumpun Gang of Four (GoF):

### 1. Strategy Pattern
- **Tujuan**: Memisahkan logika eksekusi metode pembayaran (*Bank Transfer* dan *COD*) sehingga aplikasi menjadi jauh lebih modular dan mudah ditambahkan metode pembayaran baru di masa depan tanpa mengubah class controller.
- **Letak File**:
  - `app/Patterns/Strategy/PaymentStrategy.php` (Interface)
  - `app/Patterns/Strategy/PaymentContext.php` (Context)
  - `app/Patterns/Strategy/BankTransferPayment.php` (Concrete Strategy)
  - `app/Patterns/Strategy/CODPayment.php` (Concrete Strategy)
- **Penggunaan**:
  - Digunakan di `app/Http/Services/User/CheckoutController.php` (metode `store()`).

### 2. Observer Pattern
- **Tujuan**: Memisahkan logika operasional (update status) dengan logika rekam jejak (*Activity Log*). Setiap ada update status, class akan memberitahu (*notify*) Observer untuk melakukan pencatatan log, sehingga menjauhi kode yang *tightly coupled*.
- **Letak File**:
  - `app/Patterns/Observer/Observer.php` (Interface Observer)
  - `app/Patterns/Observer/Subject.php` (Interface Subject)
  - `app/Patterns/Observer/OrderStatusSubject.php` (Concrete Subject)
  - `app/Patterns/Observer/ActivityLogObserver.php` (Concrete Observer)
- **Penggunaan**:
  - Digunakan di `app/Http/Services/Admin/OrderController.php` (metode `accept()` dan `updateStatus()`).

---

## 👥 Tabel Kontribusi Anggota Kelompok

| Nama | NIM | Peran | Fitur yang Dikerjakan | Link Video Penjelasan Individu |
|------|-----|-------|----------------------|--------------------------------|
| [Olyvia / Nama Anda] | [NIM Anda] | [Peran Anda] | Checkout, Payment Strategy & Order Status Observer | [Link YouTube/Drive] |
| [Nama Anggota 2] | [NIM Anggota 2] | [Peran Anggota 2] | [Fitur Anggota 2] | [Link YouTube/Drive] |
