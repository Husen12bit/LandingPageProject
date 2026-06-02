# LandingPageProject

LandingPageProject adalah aplikasi berbasis Laravel yang dijalankan menggunakan Docker untuk mempermudah proses development dan deployment.

---

## 🚀 Requirements

Pastikan perangkat Anda sudah terinstall:

- Docker Desktop
- Docker Compose
- Git
- Composer (Opsional)

Cek instalasi Docker:

```bash
docker --version
docker compose version
```

---

## 📥 Clone Repository

Clone repository dari GitHub:

```bash
git clone https://github.com/Husen12bit/LandingPageProject.git
cd LandingPageProject
```

---

## ⚙️ Konfigurasi Environment

Salin file environment:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada file `.env` jika diperlukan.

Contoh:

```env
APP_NAME=LandingPageProject
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=landingpage
DB_USERNAME=root
DB_PASSWORD=root
```

---

## 🐳 Menjalankan Docker

Build dan jalankan container:

```bash
docker compose up -d --build
```

Cek container yang berjalan:

```bash
docker ps
```

---

## 📦 Install Dependency Laravel

Masuk ke container Laravel:

```bash
docker compose exec app bash
```

Install dependency:

```bash
composer install
```

---

## 🔑 Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

---

## 🗄️ Migrasi Database

Jalankan migration:

```bash
php artisan migrate
```

Jika ingin mengisi data dummy:

```bash
php artisan db:seed
```

Atau:

```bash
php artisan migrate:fresh --seed
```

---

## 🧹 Clear Cache

Untuk memastikan konfigurasi terbaru digunakan:

```bash
php artisan optimize:clear
```

Atau:

```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear
```

---

## ▶️ Menjalankan Project

Pastikan semua container berjalan:

```bash
docker compose up -d
```

Akses aplikasi melalui browser:

```text
http://localhost:8000
```

---

## ⏹️ Menghentikan Project

Menghentikan container:

```bash
docker compose down
```

Menghapus container dan volume:

```bash
docker compose down -v
```

---

## 🔄 Update Project

Jika terdapat perubahan terbaru dari repository:

```bash
git pull origin main
```

Kemudian rebuild container:

```bash
docker compose down
docker compose up -d --build
```

---

## 📂 Struktur Project

```text
LandingPageProject
├── app
├── bootstrap
├── config
├── database
├── public
├── resources
├── routes
├── storage
├── tests
├── Dockerfile
├── docker-compose.yml
└── .env
```

---

## 👥 Contributors

- Muhammad Abdullah (Husen12bit)
- Fito Rifqi Dwi Fatoni
- Pius Purba

---

## 📄 License

Project ini dikembangkan untuk kebutuhan pembelajaran, pengembangan web, dan kolaborasi tim menggunakan Laravel dan Docker.
