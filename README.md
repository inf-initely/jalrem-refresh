# Jalur Rempah Website

Project Jalur Rempah - Upana Studio

## Requirements

### PHP
- PHP direkomendasikan versi ^7.4
- Aktifkan extension ext-exif di php.ini

### Composer
Composer direkomendasikan versi ^2.0

### Node & NPM
Direkomendasikan Node versi ^15.0 dan NPM versi ^7.0

## Installation & Update

Install php dependencies
``` bash
composer install
```

Install npm dependencies
```bash
npm install
```

Buat .env
```bash
cp .env.example .env
```

Generate app key
```bash
php artisan key:generate
```

Configure DB on .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations
```bash
php artisan migrate
```

Change App name on .env
```bash
APP_NAME="Jalur Rempah Kemdikbudristek Republik Indonesia"
```

### This step is required in every deployment

Run migrations
```bash
php artisan migrate
```

Sync versioning on .env
```bash
APP_VERSION=x.x.x
```

Clear/optimize system
```bash
php artisan optimize:clear
```

Make sure re-setup permissions
```bash
sudo chmod -R ug+rwx storage bootstrap/cache
```

## Run Server

Jalankan server
```bash
php artisan serve
```
