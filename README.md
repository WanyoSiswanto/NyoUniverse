# NyoUniverse

**NyoUniverse** adalah sistem manajemen kalibrasi, kualifikasi, dan mapping suhu/kelembaban untuk industri farmasi/GMP compliance.

## Fitur Utama

- **Master Data**: Kelola data alat/instrumen untuk kalibrasi, kualifikasi, dan mapping
- **Program Tahunan**: Rencanakan jadwal kalibrasi/kualifikasi/mapping per tahun
- **Realisasi**: Catat hasil pelaksanaan dengan approval workflow
- **User Management**: Manajemen pengguna dengan role-based access control
- **Custom Fields**: Tambah field dinamis per kategori tanpa migrasi database
- **Company Branding**: White-label untuk setiap instalasi
- **Bilingual UI**: Dukungan Bahasa Indonesia dan English
- **Approval Workflow**: Dua tahap persetujuan (program dan realisasi)

## Tech Stack

- **Backend**: Laravel 11.x (PHP 8.3+)
- **Admin Panel**: Filament 3.x
- **Database**: PostgreSQL 16
- **Auth**: Laravel built-in + Filament Shield (Spatie Permission)
- **Audit Trail**: Spatie Activity Log

## Cara Menjalankan (Tanpa Docker)

### Prerequisites
- PHP 8.3+ dengan ekstensi: pgsql, mbstring, xml, curl, zip, gd
- Composer
- PostgreSQL 16
- Node.js & NPM (opsional, untuk compile assets)

### Langkah-langkah

1. Clone repository:
```bash
git clone https://github.com/WanyoSiswanto/NyoUniverse.git
cd NyoUniverse
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Install dependencies:
```bash
composer install
npm install && npm run build  # Opsional
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Konfigurasi database di file `.env`:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nyouniverse
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

6. Jalankan migrasi dan seeder:
```bash
php artisan migrate --seed
```

7. Jalankan aplikasi:
```bash
php artisan serve
```

8. Akses aplikasi di: http://localhost:8000/admin

### Login Default
- **Admin**: username `admin`, password `admin123`
- **Manager**: username `manager`, password `manager123`
- **Technician 1**: username `tech1`, password `tech123`
- **Technician 2**: username `tech2`, password `tech123`

## Struktur Kategori

| Kategori | Deskripsi |
|----------|-----------|
| Kalibrasi | Alat ukur (timbangan, pH meter, spektrofotometer, dll) |
| Kualifikasi | Proses IQ/OQ/PQ/Requalifikasi (autoclave, LAF, cold room, dll) |
| Mapping | Pemetaan suhu/kelembaban (warehouse, clean room, stability chamber, dll) |

## Alur Data

```
Master Data (alat/objek) -> Program Tahunan (jadwal) -> Realisasi (hasil + approval)
```

## Lisensi

Proprietary - Untuk penggunaan internal dan komersial per-instalasi.
