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
- **Docker**: Ready untuk deployment

## Cara Menjalankan (Docker)

### Prerequisites
- Docker & Docker Compose

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

3. Generate application key:
```bash
docker compose run --rm app php artisan key:generate
```

4. Jalankan migrasi dan seeder:
```bash
docker compose run --rm app php artisan migrate --seed
```

5. Jalankan aplikasi:
```bash
docker compose up -d
```

6. Akses aplikasi di: http://localhost:8080/admin

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
