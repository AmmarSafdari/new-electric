# New Electric — Implementation Plan (Living Document)

## Decisions (LOCKED)

| Decision | Choice | Rationale |
|---|---|---|
| Stock decrement | **On Order Created** | COD store — reserve stock immediately on placement; restore if admin cancels |
| Shipping | **Flat rate PKR 200** (default) | Simple for MVP; per-city table added later if needed |
| Image storage | **Laravel public disk** | No extra dependency; fast MVP; upgrade to Spatie later if needed |

---

## Phase 1 — Core ecommerce ✅ COMPLETE

### 1. Laravel scaffold + env + README ✅
- [x] 1a. `composer create-project laravel/laravel new-electric` — init git, commit baseline
- [x] 1b. Install Filament v3 + `php artisan filament:install --panels`
- [x] 1c. Install Tailwind CSS + Alpine.js via npm (Vite)
- [x] 1d. Create `.env.example` + update README with local setup steps
- **Verify:** `php artisan about` runs clean; visit `/admin` → Filament login screen ✅

### 2. Migrations ✅
- [x] 2a. `categories` table
- [x] 2b. `brands` table
- [x] 2c. `products` table (including flash sale columns: sale_price, is_on_sale, sale_ends_at)
- [x] 2d. `orders` table
- [x] 2e. `order_items` table
- **Verify:** `php artisan migrate:fresh` runs with zero errors ✅

### 3. Seeders ✅
- [x] 3a. `CategorySeeder` — 8 rows
- [x] 3b. `BrandSeeder` — 5 rows
- [x] 3c. `ProductSeeder` — 16 products (4 featured, 4 on flash sale)
- **Verify:** `Product::count()` = 16 ✅

### 4. Filament admin resources ✅
- [x] 4a. `CategoryResource`
- [x] 4b. `BrandResource`
- [x] 4c. `ProductResource` (with flash sale section, TernaryFilter)
- [x] 4d. `OrderResource` (infolist view, status edit, cancel action)
- **Verify:** CRUD each resource in browser ✅

### 5. Storefront pages ✅
- [x] 5a. `AppLayout` (sticky header, flash sale banner, cart badge, footer)
- [x] 5b. Home (hero + categories + featured products + flash sale section)
- [x] 5c. Category listing (brand filter sidebar)
- [x] 5d. Product detail (image gallery + tabs + add to cart)
- [x] 5e. Search results
- **Verify:** All pages navigable; search works ✅

### 6. Cart (session-based) ✅
- [x] 6a. `CartService`: add/update/remove/clear/items/total/count
- [x] 6b. Routes + `CartController`
- [x] 6c. Cart page (qty spinner, line totals, shipping, grand total)
- [x] 6d. Header cart badge
- **Verify:** Add → count +1; change qty → subtotal updates; refresh → persists ✅

### 7. Checkout + order creation ✅
- [x] 7a. `CheckoutController` show() + store()
- [x] 7b. Checkout form (name, phone, city, address, notes, order summary)
- [x] 7c. Order creation: validate → DB transaction → Order + OrderItems → decrement stock → clear cart → redirect
- [x] 7d. Order success page
- **Verify:** Submit → order in DB; stock decremented; cart empty ✅

### 8. Order cancel + stock restore ✅
- [x] 8a. OrderResource cancel action
- [x] 8b. OrderObserver: cancelled → restore stock_qty
- [ ] 8c. **Feature test `OrderCancelRestoresStockTest`** *(1 hour)*
  - Create product with stock=10, place order qty=3, cancel → assert stock=10
  - `php artisan test --filter=OrderCancelRestoresStockTest` passes
  - **Verify:** `php artisan test` passes including this test

---

## Phase 2 — Import/export

### 9. CSV importer command ✅
- [x] 9a. `storage/app/csv/products_sample.csv`
- [x] 9b. `php artisan import:products {file}` — upsert by SKU
- **Verify:** Run with sample CSV → no duplicates ✅

### 10. Filament import/export UI

- [ ] 10a. **Add ImportAction to ProductResource** *(1–2 hours)*
  - Use Filament's built-in `ImportAction` or custom modal with file upload
  - On submit: call existing `import:products` logic (reuse service/command)
  - Flash count: "Imported 12, updated 4, skipped 0"
  - **Verify:** Upload `products_sample.csv` in admin → products in list; flash message shows counts

- [ ] 10b. **Add ExportAction to ProductResource** *(1 hour)*
  - Download `products_export_{date}.csv` with columns: sku, title, category_slug, brand_slug, price, stock_qty, sale_price, is_on_sale, description, warranty, is_featured
  - **Verify:** Click Export → CSV downloads; open in Excel → all products, correct columns, no empty rows

---

## Phase 3 — Homepage animation ("Room Power-Up") ✅ COMPLETE

### 11. SVG room scene ✅
- [x] 11a. `resources/views/partials/room-svg.blade.php` with `#bulb`, `#fan-blades`, `#led-strip`, `#wall-switch`
- [x] 11b. Inlined in `home.blade.php` hero section
- **Verify:** IDs present in DOM ✅

### 12. GSAP ScrollTrigger animation ✅
- [x] 12a. `npm install gsap`; `resources/js/animation.js`
- [x] 12b. Pinned timeline: bulb glow → fan spin → LED reveal → switch toggle
- [x] 12c. "Skip Animation" link
- [x] 12d. "Shop Now" CTA
- **Verify:** Scroll triggers sequence; skip link works ✅

### 13. Reduced motion + mobile guardrails ✅
- [x] 13a. `prefers-reduced-motion` check → skip GSAP, apply CSS fade
- [x] 13b. Mobile guard (`< 768px`) → stagger fade only
- [x] 13c. `<script defer>` on animation.js
- **Verify:** Emulate reduced-motion → static hero; 375px → no jank ✅

---

## Phase 4 — Production hardening + deploy

### 14. SEO

- [ ] 14a. **Meta stack in AppLayout** *(1 hour)*
  - Add `@stack('meta')` in `<head>`
  - Default: `<meta name="description">` (site tagline), OG title, OG type=website, OG URL
  - **Verify:** View source on `/` → meta description and OG tags present

- [ ] 14b. **Product detail meta push** *(30 min)*
  - `@push('meta')`: title = product name, description = first 160 chars of description, OG image = first product image URL
  - **Verify:** View source on any product page → correct OG tags matching that product

- [ ] 14c. **Sitemap + robots** *(already done — verify only)*
  - Confirm `/sitemap.xml` valid XML with home + category + product URLs
  - Confirm `/robots.txt` has `Disallow: /admin`
  - **Verify:** Both URLs accessible and correct ✅

### 15. Performance

- [ ] 15a. **Lazy-load images** *(30 min)*
  - Add `loading="lazy"` to all `<img>` in product cards, category cards, product detail thumbs
  - Keep hero/logo images without lazy (above fold)
  - **Verify:** DevTools Network → images below fold have `loading="lazy"` attribute

- [ ] 15b. **Bundle size check** *(30 min)*
  - `npm run build` → confirm no JS chunk > 200KB
  - If any chunk > 200KB: dynamic import the offending module
  - **Verify:** Build output shows all chunks within limits (GSAP ~90KB is acceptable)

### 16. Security

- [ ] 16a. **`CheckoutRequest` Form Request** *(1 hour)*
  - Create `app/Http/Requests/CheckoutRequest.php`
  - Rules: name (required, string, max:100), phone (required, regex:`/^(\+92|03)\d{9}$/`), city (required, string), address (required, string, max:300), notes (nullable, string, max:500)
  - Use in `CheckoutController::store()` instead of manual `$request->validate()`
  - **Verify:** Submit empty form → each field shows inline validation error; invalid phone `12345` → phone error shown

- [ ] 16b. **Rate limit checkout** *(15 min)*
  - Add `throttle:5,1` middleware on `POST /checkout` route in `routes/web.php`
  - **Verify:** Submit checkout 6 times in 1 minute → 6th returns 429 response

- [ ] 16c. **CSRF + XSS audit** *(30 min)*
  - Grep all Blade views for `{!! !!}` — verify none used on user-supplied data
  - Verify `@csrf` present in cart form, checkout form, any POST forms
  - **Verify:** `<script>alert(1)</script>` in name field at checkout → escaped in order detail, not executed

### 17. DEPLOY_HOSTINGER.md

- [ ] 17a. **Prerequisites section** *(30 min)*
  - PHP 8.2+, MySQL 5.7+, Composer 2, Node (for local build only), Git
  - Hostinger: set PHP 8.3 in hPanel → PHP Configuration

- [ ] 17b. **Upload & install steps** *(30 min)*
  - Upload zip to `public_html/New-electric/`; extract
  - Set subdomain document root to `public_html/New-electric/public`
  - Copy `.env.example` → `.env`; fill DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL

- [ ] 17c. **Post-install commands** *(15 min)*
  - `php artisan key:generate`
  - `php artisan migrate --force`
  - Manual symlink: `ln -s /home/{user}/public_html/New-electric/storage/app/public /home/{user}/public_html/New-electric/public/storage` (exec() disabled on shared hosting)
  - `php artisan config:cache && php artisan route:cache && php artisan view:cache`
  - `chmod -R 775 storage bootstrap/cache`

- [ ] 17d. **Verification checklist** *(15 min)*
  - Visit `/` → home loads with animation
  - Visit `/admin` → Filament login screen
  - Add product to cart → badge updates
  - Place test COD order → success page; check admin Orders → order present; stock decremented
  - Visit `/sitemap.xml` → valid XML
  - **Verify:** Doc is self-contained; a fresh Hostinger deploy following it results in working site

---

## Definition of Done
All acceptance tests in `specs/PRD.md` pass.
