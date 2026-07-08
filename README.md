# miniEcommerce - UD Trisna Putra

Aplikasi E-Commerce berbasis web untuk membantu proses belanja kebutuhan bahan kue dan kemasan secara online pada **UD Trisna Putra**.

---

## 1. Deskripsi Project
**miniEcommerce UD Trisna Putra** adalah aplikasi e-commerce yang dikembangkan untuk memperluas jangkauan pasar dan mempermudah pelanggan dalam berbelanja bahan kue, alat baking, serta kemasan plastik. Sistem ini mendigitalisasi katalog produk dan menangani transaksi pemesanan secara terpusat.

Project ini dikembangkan secara komprehensif mulai dari perancangan database, pembuatan sistem autentikasi, manajemen data (CRUD), hingga desain UI yang responsif. Selain fokus pada fitur, pengembangan sistem ini juga menerapkan prinsip-prinsip *Software Engineering* yang baik seperti *Clean Code*, *Layered Architecture*, dan *Design Patterns*.

## 2. Ruang Lingkup Sistem
Sistem ini dirancang untuk dua pengguna utama:
- **Admin**: Bertanggung jawab mengelola katalog produk, kategori, dan melihat pesanan.
- **Customer**: Pengguna akhir yang mencari produk, mengelola keranjang, dan melakukan pemesanan.

## 3. Fitur Utama

### Admin
- **Autentikasi:** Login khusus Admin.
- **Manajemen Kategori:** CRUD data kategori.
- **Manajemen Produk:** CRUD data produk lengkap dengan gambar, harga, dan stok.
- **Manajemen Pesanan:** (Akan datang) Melihat dan memperbarui status pesanan.

### Customer
- **Autentikasi:** Registrasi dan Login akun Customer.
- **Katalog Produk:** Mencari produk, memfilter berdasarkan kategori.
- **Keranjang Belanja:** Menambah/mengubah/menghapus item di keranjang.
- **Checkout & Pesanan:** Melakukan *checkout* dan melihat riwayat pesanan (dengan validasi radius jarak toko).

## 4. Tech Stack
- **Backend:** Laravel 11 (PHP 8)
- **Frontend:** Laravel Blade, Tailwind CSS v3, AlpineJS
- **Database:** MySQL
- **Assets:** Vite

## 5. Arsitektur & Design Patterns
Project ini menerapkan pendekatan **Layered Architecture** di atas fondasi MVC Laravel. Terdapat pemisahan jelas antara *Presentation Layer* (Controllers/Views), *Business Logic Layer* (Services), dan *Data Access Layer* (Models).

Selain itu, project ini mengimplementasikan beberapa Design Pattern (GoF):
- **Singleton Pattern:** Digunakan pada `DistanceService` untuk efisiensi memori (koordinat toko statis).
- **Factory Method Pattern:** Digunakan pada *Role-based redirection* saat user login.
- **Strategy & Observer Pattern:** Diimplementasikan untuk mengelola aksi dinamis.

💡 **Penjelasan detail dan diagram Arsitektur:** Silakan lihat [docs/arsitektur.md](docs/arsitektur.md).

## 6. Database & ERD
Aplikasi ini memiliki tabel utama: `users`, `categories`, `products`, `orders`, dan `order_items`.

💡 **Lihat Entity Relationship Diagram (ERD):** Silakan lihat [docs/database.md](docs/database.md).

## 7. Cara Menjalankan Project Secara Lokal

1. Clone repositori ini:
   ```bash
   git clone https://github.com/liv-lauflove/miniEcommerce.git
   cd miniEcommerce
   ```
2. Install dependensi PHP dan Node.js:
   ```bash
   composer install
   npm install
   ```
3. Buat file konfigurasi environment:
   ```bash
   cp .env.example .env
   ```
4. Sesuaikan konfigurasi `.env` untuk database, lalu generate *app key*:
   ```bash
   php artisan key:generate
   ```
5. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
6. *Build* asset frontend dan jalankan server lokal:
   ```bash
   npm run dev
   php artisan serve
   ```

## 8. Testing, Linter, dan Formatting
Untuk menjaga kualitas dan kerapian kode (*Clean Code*), project ini menggunakan tool standardisasi:
- **Pint (Laravel Code Style):** `./vendor/bin/pint`
- **Testing:** `php artisan test`

## 9. GitFlow dan Conventional Commits
Pengembangan project menggunakan standar **GitFlow** (menggunakan branch `dev`, `main`, dan `feature/*` atau `refactor/*`) dengan metode kolaborasi melalui **Pull Requests (PR)**.
Setiap riwayat perubahan direkam menggunakan standar **Conventional Commits**:
- `feat:` Menambahkan fitur baru.
- `fix:` Memperbaiki bug.
- `refactor:` Merapikan atau mengubah struktur kode (seperti UI Redesign).
- `docs:` Pembaruan dokumentasi.

---
