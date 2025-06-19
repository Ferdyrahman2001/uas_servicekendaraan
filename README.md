# 🚗 ServiceKuy - Sistem Service Kendaraan - Project Belajar Filament

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-FF5722?logo=filamentphp&logoColor=white)

Project belajar membangun **CRUD Management System** untuk bengkel kendaraan menggunakan:

-   Laravel 12
-   Filament PHP 3.x
-   MySQL
-   Tailwind CSS

## 📋 Daftar Isi

-   [Fitur](#-fitur)
-   [Struktur Database](#-struktur-database)
-   [Panduan Instalasi](#%EF%B8%8F-panduan-instalasi)
-   [Cara Penggunaan](#-cara-penggunaan)
-   [Tim Pengembang](#-tim-pengembang)

## 🌟 Fitur

-   **Manajemen Layanan**
    -   CRUD layanan kendaraan
    -   Upload foto kendaraan
    -   Status layanan (Pending/Proses/Selesai)
-   **Manajemen Montir**
    -   Assign montir ke layanan
    -   Tracking pekerjaan
-   **Sistem Pembayaran**
    -   Hitung total biaya otomatis
    -   Validasi pembayaran
-   **Role-based Access**
    -   Admin
    -   Manager
    -   Montir

## 🗃️ Struktur Database

![Diagram ERD](./public/images/erd-diagram.png) _(Ganti dengan path gambar ERD Anda)_

Tabel utama:

1. `layanans` - Data layanan kendaraan
2. `detail_layanans` - Detail pekerjaan per layanan
3. `montirs` - Data montir
4. `users` - User admin/manager

## 🛠️ Panduan Instalasi

### Prasyarat

-   PHP 8.3+
-   Composer 2.5+
-   Node.js 18+
-   MySQL 8.0+

### Langkah 1: Clone Repository

```bash
git clone https://github.com/username/project-bengkel.git
cd project-bengkel
```

### Langkah 2: Install Dependencies

```bash
composer install
npm install
```

### Langkah 3: Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai kebutuhan, misal:

```env
DB_DATABASE=db_bengkel
DB_USERNAME=root
DB_PASSWORD=
APP_URL=http://localhost:8000
```

### Langkah 4: Jalankan Migrasi

```bash
php artisan migrate --seed
```

Seeder akan membuat:

-   1 admin (`admin@gmail.com` / `admin123`)
-   5 data montir
-   10 data layanan contoh

### Langkah 5: Build Assets

```bash
npm run build
```

### Langkah 6: Jalankan Aplikasi

```bash
php artisan serve
```

Buka: [http://localhost:8000](http://localhost:8000)

## 🖥️ Cara Penggunaan

1. **Login**

-   Gunakan credential default:
    -   **Email:** `admin@gmail.com`
    -   **Password:** `admin123`

2. **Tambah Layanan Baru**

-   Navigasi ke menu **Layanan** > **Tambah Baru**
-   Isi form layanan:
    -   Upload foto kendaraan
    -   Tambah detail pekerjaan dan pilih montir
-   Sistem akan otomatis menghitung total biaya

3. **Update Status Layanan**

-   Ubah status layanan sesuai progres:
    -   `Pending` → `Proses` → `Selesai`

## 👨‍💻 Tim Pengembang

-   Raffi Ramadhan Tajudin

## 📝 Catatan Belajar

**Yang Sudah Dipelajari:**

-   Membuat CRUD dengan Filament
-   Relasi one-to-many
-   Form repeater
-   Validasi custom

---

## 📄 Hak Cipta

-   Laravel® adalah merek dagang terdaftar milik Taylor Otwell.
-   FilamentPHP® adalah merek dagang milik Dan Harrin dan kontributor Filament.
-   Proyek ini hanya untuk tujuan pembelajaran dan tidak berafiliasi dengan pihak resmi Laravel maupun Filament.
