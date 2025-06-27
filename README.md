# README

## Informasi Aplikasi

- **Framework:** Laravel 12  
- **PHP Version:** 8.2
- **Packages Penting:**  
  - laravel/framework ^12.0  
  - maatwebsite/excel ^3.1  
  - owen-it/laravel-auditing ^14.0  
  - spatie/laravel-permission ^6.17  


## Daftar Username dan Password Default

| Role  | Email           | Password   |
|-------|-----------------|------------|
| Admin | admin@admin.com | admin1234  |
| Staff | staff@staff.com | staff1234  |

> **Catatan:** Password sudah di-hash menggunakan bcrypt. Gunakan email dan password di atas untuk login pertama kali.

---

## Panduan Penggunaan Aplikasi

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan program ini di komputer lokal:

### 1. Clone Repository

git clone <URL_REPOSITORY_ANDA>

### 2. Masuk Repository
cd nama-folder-project

### 3. Jalankan Terminal (Git Bash / CMD / VS Code Terminal)

### 4.  Install Dependency Laravel
composer install

### 5. konfigurasi .env
cp .env.example .env
php artisan key:generate

### 6. Jalankan program dengan
php artisan migrate

### 7. Jalankan Seeder untuk Isi Data Awal (termasuk akun login)
php artisan db:seed

### 8. Jalankan Program
php artisan serve
