# New Electric — Implementation Plan (Living Document)

## Decisions (LOCKED)

| Decision | Choice | Rationale |
|---|---|---|
| Stock decrement | **On Order Created** | COD store — reserve stock immediately on placement; restore if admin cancels |
| Shipping | **Flat rate PKR 200** (default) | Simple for MVP; per-city table added later if needed |
| Image storage | **Laravel public disk** | No extra dependency; fast MVP; upgrade to Spatie later if needed |

---

## Phase 1 — Core ecommerce

### 1. Laravel scaffold + env + README
- [ ] 1a. `composer create-project laravel/laravel new-electric` — init git, commit baseline
- [ ] 1b. Install Filament v3 (`composer require filament/filament:"^3.0"` + `php artisan filament:install --panels`)
- [ ] 1c. Install Tailwind CSS + Alpine.js via npm (Vite)
- [ ] 1d. Create `.env.example` (DB, APP_URL, no secrets) + update README with local setup steps
- **Verify:** `php artisan about` runs clean; visit `/admin` → Filament login screen

### 2. Migrations
- [ ] 2a. `categories`: id, name, slug, description, image, timestamps
- [ ] 2b. `brands`: id, name, slug, logo, timestamps
- [ ] 2c. `products`: id, category_id (FK), brand_id (FK nullable), title, slug, sku (unique), price (decimal 10,2), stock_qty (int default 0), images (JSON), description (text), specs (JSON nullable), warranty (string nullable), is_featured (bool default false), timestamps
- [ ] 2d. `orders`: id, name, phone, city, address, notes, subtotal, shipping_fee, total, status (enum: pending/confirmed/processing/shipped/delivered/cancelled), payment_method (default 'cod'), timestamps
- [ ] 2e. `order_items`: id, order_id (FK cascade), product_id (FK), title (snapshot), sku (snapshot), unit_price (decimal), qty (int), line_total (decimal), timestamps
- **Verify:** `php artisan migrate:fresh` runs with zero errors; inspect tables in MySQL

### 3. Seeders
- [ ] 3a. `CategorySeeder` — 8 rows: Batteries, Standing Fans, Plugs, Extension Boards, Adapters, Bulbs & Lights, Emergency Lights, Wires
- [ ] 3b. `BrandSeeder` — 5 rows: Sogo, SuperAsia, Philips, Panasonic, Local Generic
- [ ] 3c. `ProductSeeder` — 16 products across categories; realistic PKR prices; varied stock qtys; `is_featured` on 4
- **Verify:** `php artisan db:seed` succeeds; `php artisan tinker --execute="echo \App\Models\Product::count();"` prints 16

### 4. Filament admin resources
- [ ] 4a. `CategoryResource`: table (name, slug, actions), create/edit form (name → auto-slug, description, image upload)
- [ ] 4b. `BrandResource`: table (name, slug), create/edit form
- [ ] 4c. `ProductResource`: table (title, sku, category, price PKR, stock, featured badge); search by title/sku; filter by category/brand; form with all product fields + image upload (multiple)
- [ ] 4d. `OrderResource`: table (order#, customer name, total, status badge, date); filter by status; detail view with order items (read-only); edit status (select + save)
- **Verify:** CRUD each resource in browser; create product → appears in list; change order status → DB updated

### 5. Storefront pages
- [ ] 5a. `AppLayout`: sticky header (logo, categories nav, search icon, cart icon + count), footer (links, address, socials placeholder)
- [ ] 5b. Home: hero section placeholder (static for now, animation in Phase 3), 8 category cards, featured products grid (4)
- [ ] 5c. Category listing: breadcrumb, product grid (3–4 cols), filter sidebar (brand checkboxes, Alpine.js, no page reload)
- [ ] 5d. Product detail: image gallery (main + thumbs, Alpine.js), price PKR, stock badge, description tab, specs tab, warranty, "Add to Cart" button
- [ ] 5e. Search results: `?q=` param, product grid or "no results" message, heading shows query
- **Verify:** Navigate all pages; products/categories display correctly; search for "fan" returns fan products

### 6. Cart (session-based)
- [ ] 6a. `CartService`: `add(productId, qty)`, `update(productId, qty)`, `remove(productId)`, `clear()`, `items()`, `total()`, `count()` — stored in `session('cart')`
- [ ] 6b. Routes + `CartController`: POST `/cart/add`, PATCH `/cart/update`, DELETE `/cart/remove`, GET `/cart`
- [ ] 6c. Cart page: table of items (image, title, qty spinner with Alpine.js +/−, line total, remove), order subtotal + shipping (flat PKR 200), grand total, "Checkout" button
- [ ] 6d. Header cart icon: Alpine.js x-data reads cart count from meta tag set by controller; no page reload needed
- **Verify:** Add product → count +1 in header; change qty → subtotal updates; remove → item gone; refresh → cart still there (session persisted)

### 7. Checkout + order creation + success
- [ ] 7a. `CheckoutController`: `show()` (GET `/checkout`) and `store()` (POST `/checkout`)
- [ ] 7b. Checkout form: Name, Phone (Pakistan +92 or 03xx), City (text), Street address, Order notes (optional); right sidebar: order summary with line items + totals; COD badge ("Pay on Delivery")
- [ ] 7c. Order creation in `store()`: validate → DB transaction → create Order → create OrderItems → **decrement stock_qty** on each product → clear cart → redirect to success
- [ ] 7d. Order success page: "Order Placed!" heading, order number, summary table, estimated delivery note, "Continue Shopping" button
- **Verify:** Submit valid checkout → order in DB; `product->stock_qty` decremented; cart empty after; success page shows correct order number

### 8. Order status management + stock restore on cancel
- [ ] 8a. `OrderResource` status actions: buttons in detail view — "Confirm", "Mark Shipped", "Mark Delivered", "Cancel"
- [ ] 8b. Cancel logic: Observer or service — when status → `cancelled`, restore `stock_qty` for each order item
- [ ] 8c. Feature test: `OrderCancelRestoresStockTest` — create order with qty, cancel, assert stock restored
- **Verify:** Cancel order in admin → stock_qty restored; `php artisan test` passes including new test

---

## Phase 2 — Import/export

### 9. CSV importer command
- [ ] 9a. Create `storage/app/csv/products_sample.csv` with columns: sku, title, category_slug, brand_slug, price, stock_qty, description, warranty, is_featured
- [ ] 9b. Artisan command `php artisan import:products {file}`: read CSV, upsert by SKU (create or update), resolve category/brand by slug, log results
- **Verify:** Run with sample CSV → 16 rows upserted; run again → no duplicates; `Product::count()` unchanged

### 10. Filament import/export UI
- [ ] 10a. Add import action on `ProductResource` table: upload CSV file → trigger import logic → flash success/error count
- [ ] 10b. Add export action: download `products_export.csv` with all current products
- **Verify:** Upload CSV in admin → products appear in list; download export → open in Excel, all columns correct

---

## Phase 3 — Homepage animation ("Room Power-Up")

### 11. SVG room scene
- [ ] 11a. Create `resources/svg/room-scene.svg`: outlines of a simple room with: `#bulb` group, `#fan-blades` group, `#led-strip` rect, `#wall-switch` group — all initially in "off" state (dark/muted)
- [ ] 11b. Inline the SVG in `home.blade.php` hero section, wrapped in `<div id="room-animation-hero">`
- **Verify:** Open home page → SVG visible; inspect DOM → IDs `#bulb`, `#fan-blades`, `#led-strip`, `#wall-switch` present

### 12. GSAP ScrollTrigger animation
- [ ] 12a. `npm install gsap`; import in `resources/js/animation.js`
- [ ] 12b. Timeline: pin `#room-animation-hero` for 1.5 scroll screens → bulb: opacity + drop-shadow glow → fan: rotation 0→360 (repeat) → LED: clipPath reveal left-to-right → switch: translateX toggle
- [ ] 12c. "Skip Animation" link (`<a href="#products-section">Skip</a>`) visible immediately top-right of hero, scrolls past pinned zone
- [ ] 12d. "Shop Now" CTA button overlaid on hero, visible without scrolling, links to `#products-section`
- **Verify:** Scroll triggers each element in sequence; Shop Now visible on load; Skip link jumps to products; animation ends and page flows normally

### 13. Reduced motion + mobile guardrails
- [ ] 13a. In `animation.js`: check `window.matchMedia('(prefers-reduced-motion: reduce)').matches` → if true, skip GSAP, apply single CSS fade-in class to hero instead
- [ ] 13b. Mobile guard: if `window.innerWidth < 768` → skip ScrollTrigger pin, just do a simple stagger fade-in for room elements
- [ ] 13c. Defer `animation.js` load (`<script defer>`) so it never blocks first paint
- **Verify:** DevTools → Rendering → "Emulate CSS media feature prefers-reduced-motion: reduce" → no animation, static hero; resize to 375px → no layout jank; Lighthouse performance score ≥ 70

---

## Phase 4 — Production hardening + deploy

### 14. SEO
- [ ] 14a. `AppLayout`: `@stack('meta')` slot; default meta description and OG tags
- [ ] 14b. Product detail: `@push('meta')` with product title, description (first 160 chars), OG image (first product image)
- [ ] 14c. `/sitemap.xml` route: lists home, all category URLs, all product URLs with `<lastmod>`
- [ ] 14d. `public/robots.txt`: `Disallow: /admin`
- **Verify:** View source on product page → correct OG tags; visit `/sitemap.xml` → valid XML; `/robots.txt` → disallows /admin

### 15. Performance
- [ ] 15a. All `<img>` tags: add `loading="lazy"` except first above-fold image (hero/logo)
- [ ] 15b. `npm run build` → check bundle; no chunk > 200KB (GSAP is ~90KB, acceptable)
- [ ] 15c. Add caching commands to deploy checklist: `route:cache`, `config:cache`, `view:cache`
- **Verify:** Lighthouse mobile performance ≥ 70; no render-blocking resources beyond Vite entry

### 16. Security
- [ ] 16a. `CheckoutRequest` Form Request: name (required, max 100), phone (required, regex `/^(\+92|03)\d{9}$/`), city (required), address (required, max 300)
- [ ] 16b. Rate limit checkout POST: add `throttle:5,1` middleware on checkout route
- [ ] 16c. Audit all Blade views: no `{!! !!}` on user-supplied data; CSRF `@csrf` on every form
- **Verify:** Submit empty form → validation errors shown inline; submit 6 times in 1 min → 429 response; no XSS: `<script>alert(1)</script>` in name field → escaped in output

### 17. DEPLOY_HOSTINGER.md
- [ ] 17a. Prerequisites section: PHP 8.1+, MySQL, Composer, Node (optional for build), Git
- [ ] 17b. Upload & install: git clone or FTP upload, `composer install --no-dev --optimize-autoloader`, copy `.env.example` to `.env`, fill DB creds + APP_URL
- [ ] 17c. Post-install commands: `php artisan key:generate`, `php artisan migrate --seed`, `php artisan storage:link`, `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`
- [ ] 17d. Verification checklist: visit `/`, visit `/admin` (login works), add to cart, place test COD order, confirm stock decremented in admin, check `/sitemap.xml`
- **Verify:** Developer follows doc from scratch on a clean Hostinger instance → site works

---

## Definition of Done
All acceptance tests in `specs/PRD.md` pass.
