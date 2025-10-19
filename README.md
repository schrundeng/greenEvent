# 🌿 GreenEvent

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-v11-red)]()
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4.0.0-blue)]()
[![Vite](https://img.shields.io/badge/Vite-v7.0.7-purple)]()
[![PostgreSQL](https://img.shields.io/badge/Database-PostgreSQL-green)]()
[![Leaflet](https://img.shields.io/badge/Leaflet-Map_Library-lightgreen)]()

---

## 📝 Deskripsi Singkat

**GreenEvent** adalah platform web berbasis **Laravel** yang dirancang untuk membantu pengguna menemukan dan berpartisipasi dalam berbagai **acara bertema lingkungan**.
Aplikasi ini memanfaatkan **peta interaktif berbasis Leaflet.js** untuk menampilkan lokasi acara secara visual, lengkap dengan detail seperti judul, tempat, dan status acara.

Dari sisi fungsionalitas, **GreenEvent** memungkinkan admin untuk membuat serta mengelola acara, sedangkan pengguna umum dapat menelusuri, mendaftar, atau sekadar menjelajahi lokasi kegiatan ramah lingkungan di sekitar mereka.
Secara konsep, proyek ini berfokus pada **keterlibatan masyarakat dalam gerakan hijau**, menghubungkan komunitas pecinta alam dengan berbagai inisiatif dan event lingkungan.

---

## 📚 Daftar Isi

1. [Fitur](#fitur-✨)
2. [Teknologi yang Digunakan](#teknologi-yang-digunakan-💻)
3. [Instalasi](#instalasi-⚙️)
4. [Cara Penggunaan](#cara-penggunaan-🚀)
5. [Struktur Proyek](#struktur-proyek-📂)
6. [Kontribusi](#kontribusi-🤝)
7. [Lisensi](#lisensi-©️)
8. [Tautan Penting](#tautan-penting-🔗)
9. [Footer](#footer-🚀)

---

## ✨ Fitur

* **Autentikasi Pengguna**
  Menggunakan **Laravel Breeze** dengan sistem registrasi, login, dan kontrol akses berbasis peran (admin & user).

* **Manajemen Acara**
  Admin dapat membuat, memperbarui, dan menghapus acara, lengkap dengan kategori, deskripsi, tanggal, lokasi (koordinat), dan gambar poster.

* **Daftar & Kategori Acara**
  Menampilkan daftar acara berdasarkan kategori dengan filter status acara (berlangsung, akan datang, selesai).

* **Pendaftaran Peserta**
  Pengguna dapat mendaftar ke acara tertentu dengan data nama, email, dan nomor telepon. Semua data tersimpan dalam tabel `regis`.

* **Integrasi Peta Interaktif**
  Menampilkan lokasi acara menggunakan **Leaflet.js** dengan file data **GeoJSON** (`public/Kota Malang.geojson`), memudahkan pencarian lokasi berbasis peta.

* **Animasi dan Antarmuka Modern**
  Menggunakan **AOS (Animate On Scroll)** dan **Tailwind CSS** untuk tampilan yang dinamis, modern, serta responsif di berbagai perangkat.

* **Sistem Notifikasi Interaktif**
  Menggunakan **SweetAlert2** untuk menampilkan konfirmasi dan pesan interaktif.

* **Pengujian Otomatis**
  Pengujian unit dan fitur menggunakan **PHPUnit** untuk menjaga kualitas kode.

---

## 💻 Teknologi yang Digunakan

| Kategori                      | Teknologi / Alat               |
| ----------------------------- | ------------------------------ |
| **Backend Framework**         | Laravel 11                     |
| **Autentikasi & Scaffolding** | Laravel Breeze                 |
| **Frontend Styling**          | Tailwind CSS                   |
| **Animasi**                   | AOS – Animate On Scroll        |
| **Peta Interaktif**           | Leaflet.js                     |
| **Build Tool**                | Vite                           |
| **Bahasa Pemrograman**        | PHP, JavaScript, CSS           |
| **Database**                  | PostgreSQL                     |
| **Version Control**           | Git & GitHub                   |
| **Ikon & Komponen UI**        | Font Awesome                   |
| **Notifikasi & Modal**        | SweetAlert2                    |
| **Dependency Manager**        | Composer (PHP) & NPM (Node.js) |

---

## ⚙️ Instalasi

1. **Klon repositori:**

   ```bash
   git clone https://github.com/schrundeng/greenEvent.git
   cd greenEvent
   ```

2. **Instal dependensi Composer:**

   ```bash
   composer install
   ```

3. **Salin file `.env` dan sesuaikan konfigurasi:**

   ```bash
   cp .env.example .env
   ```

   Ubah konfigurasi database sesuai kebutuhan, contoh:

   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=greenevent
   DB_USERNAME=postgres
   DB_PASSWORD=yourpassword
   ```

4. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

5. **Migrasi database:**

   ```bash
   php artisan migrate
   ```

6. **Instal dependensi frontend:**

   ```bash
   npm install
   ```

7. **Jalankan server lokal dan Vite:**

   ```bash
   php artisan serve
   npm run dev
   ```

---

## 🚀 Cara Penggunaan

1. Jalankan aplikasi di `http://127.0.0.1:8000`.
2. Buat akun baru atau login menggunakan akun yang sudah ada.
3. Admin dapat menambahkan dan mengelola acara melalui dashboard.
4. Pengguna umum dapat menjelajahi dan mendaftar ke acara yang diinginkan.
5. Lokasi acara dapat dilihat langsung melalui peta interaktif.

---

## 📂 Struktur Proyek

```
greenEvent/
├── app/                    # Kode utama aplikasi
│   ├── Http/               # Controller dan Middleware
│   ├── Models/             # Model Eloquent
│   ├── Providers/          # Service Provider
├── bootstrap/              # File bootstrap
├── config/                 # File konfigurasi
├── database/               # Migrasi & seeder
├── public/                 # Aset publik (CSS, JS, gambar, GeoJSON)
│   └── Kota Malang.geojson
├── resources/              # View dan aset frontend
│   ├── css/
│   ├── js/
│   └── views/
├── routes/                 # Definisi rute
├── storage/                # Direktori penyimpanan
├── tests/                  # Unit & Feature Tests
├── .env                    # Konfigurasi lingkungan
├── package.json            # Dependensi npm
├── vite.config.js          # Konfigurasi Vite
└── composer.json           # Dependensi Composer
```

---

## 🤝 Kontribusi

Kontribusi terbuka untuk siapa pun.
Langkah kontribusi:

1. Fork repositori ini.
2. Buat branch baru untuk fitur atau perbaikan bug.
3. Commit perubahan dengan pesan yang jelas.
4. Kirim Pull Request untuk ditinjau.

---

## ©️ Lisensi

Proyek ini dirilis di bawah lisensi **[MIT License](https://opensource.org/licenses/MIT)** dan bersifat open source.

---

## 🔗 Tautan Penting

* **Repositori GitHub:** [https://github.com/schrundeng/greenEvent](https://github.com/schrundeng/greenEvent)
* **Demo Langsung:** *Belum tersedia*
* **Kontak Resmi:** [greeneventplatform@gmail.com](mailto:greeneventplatform@gmail.com)

---

## 🚀 Footer

**Tim Pengembang:**
| Nama                                                                        | Peran                                          | Tanggung Jawab                                                                                                                                                                       |
| --------------------------------------------------------------------------- | ---------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| **Naufal Rakha Putra** — [@sternnaufal](https://github.com/sternnaufal)     | 🧭 **Project Lead & Frontend Developer (QA)**  | Mengatur arah proyek, merancang antarmuka pengguna menggunakan Tailwind CSS dan AOS, memastikan kualitas tampilan dan animasi berjalan optimal, serta melakukan pengujian antarmuka. |
| **Muhammad Naufal Ramadhan** — [@schrundeng](https://github.com/schrundeng) | ⚙️ **Backend Engineer (System Architect & Routing)** | Merancang struktur database PostgreSQL, menangani migrasi dan relasi antar tabel, serta memastikan stabilitas dan performa sistem backend secara keseluruhan.                |
| **Ghaura Furqon Nugraha** — [@ghawra](https://github.com/ghawra)            | 🏗️ **Backend Developer (Authentication & Mailing)**   |     Mengembangkan logika autentikasi dan manajemen pengguna menggunakan Laravel Breeze, mengelola koneksi database, serta memastikan keamanan sistem login dan registrasi.                   |


⭐️ Dukung proyek ini dengan memberi **star**, melakukan **fork**, atau mengajukan **issue/kontribusi baru**.
Terima kasih telah mendukung inisiatif **GreenEvent** 🌱

> *“Connecting people to a greener future.”*