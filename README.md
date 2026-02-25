# New Electric

Pakistan electrical general store — Laravel 11 + Filament v3 + Tailwind CSS ecommerce site.

## Local Setup

1. `composer install`
2. `cp .env.example .env && php artisan key:generate`
3. Edit `.env`: set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
4. `php artisan migrate --seed`
5. `php artisan storage:link`
6. `npm install && npm run build`
7. `php artisan make:filament-user`
8. `php artisan serve` → visit http://localhost:8000 | admin: /admin

## Stack
- Laravel 11 + MySQL
- Filament v3 (admin panel)
- Tailwind CSS v4 (via Vite)
- Alpine.js + GSAP + ScrollTrigger

## Deployment
See `DEPLOY_HOSTINGER.md`.
