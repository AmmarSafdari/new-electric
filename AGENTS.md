## New Electric — Stack & Commands

### Stack (locked)
- Laravel 11 + MySQL
- Filament v3 (admin)
- Blade + Tailwind CSS
- Alpine.js
- GSAP + ScrollTrigger for homepage animation

### Local setup
- composer install
- cp .env.example .env
- php artisan key:generate
- configure DB in .env
- php artisan migrate --seed
- npm install
- npm run dev (or npm run build)

### Quality gates (run often)
- php artisan test
- ./vendor/bin/pint

### Hosting target
- Hostinger shared hosting or VPS (Laravel + MySQL)
- Must include DEPLOY_HOSTINGER.md later