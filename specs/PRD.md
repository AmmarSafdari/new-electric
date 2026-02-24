# New Electric — PRD (Pakistan Electrical General Store Ecommerce)

## Overview
Build a production-ready ecommerce website for **New Electric** (Pakistan). Must be deployable on **Hostinger** and fully functional: storefront + cart + checkout + orders + admin panel for product management.

## Non-negotiables
- Non “AI-template” look: bespoke UI, real brand feel, clean typography, subtle motion.
- Homepage has a **short scroll-reactive “Room Power-Up” animation** that is skippable and mobile-safe.
- Admin backend: secure login + CRUD products/categories/brands/orders + CSV import/export.
- Checkout supports **Cash on Delivery (COD)** (mandatory). Other payment methods can be placeholders.

## Product scope
Initial inventory includes:
- Batteries (all kinds)
- Standing fans
- Plugs
- Extension boards
- Adapters
- Bulbs / Lights
- Emergency lights
- Wires
- General electrical essentials

Products sourced from Sogo and other suppliers. **Do NOT scrape external websites.** Provide CSV import workflow and seed sample products manually.

## Pages
- Home (animation hero + categories + featured products)
- Category listing
- Product detail
- Search results
- Cart
- Checkout
- Order success
- About / Contact
- Shipping policy / Returns policy / Privacy policy

## Data model (minimum)
- Products, Categories, Brands, Orders, OrderItems
- Product fields: title, slug, sku, price PKR, stock_qty, images, description, specs JSON, warranty

## Homepage animation (“Room Power-Up”)
### Behavior
- On load: user sees room scene with electrical items (SVG or lightweight animation)
- On scroll: items “turn on” quickly:
  - bulb glow
  - fan spins
  - LED strip wipe
  - switch toggle
- Must finish within ~1–2 scroll screens
- Must include “Shop Now” CTA + “Skip animation” link immediately
- Respect `prefers-reduced-motion` (static hero + tiny fade)

## SEO / Performance
- Meta tags, OG tags
- Lazy-loaded images
- Fast on mobile
- No huge blocking assets

## Deployment (Hostinger)
- Laravel + MySQL deploy steps documented
- Storage symlink, migrations, seeds, caching steps

## Acceptance tests (Definition of Done)
### Storefront
- User can browse categories and products
- Search and filters work
- Cart persists across refresh
- Checkout creates an order in DB
- Stock decreases when order is created (or on Confirmed — document decision)

### Admin
- Admin can create/edit/delete product and it reflects on site
- Admin can upload CSV to import products
- Admin can change order status
- Export works

### Animation
- Skip jumps to product section
- Doesn’t block shopping
- Mobile performance acceptable

### Deployment
- Fresh clone + documented steps result in working site