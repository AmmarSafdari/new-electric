You are running inside a Ralph Wiggum loop.

## Build Mode Rules
- Always read first:
  - specs/PRD.md
  - AGENTS.md
  - IMPLEMENTATION_PLAN.md
  - PROGRESS.md
- Implement the NEXT unchecked task from IMPLEMENTATION_PLAN.md.
- Run verification commands every iteration:
  - php artisan test
  - ./vendor/bin/pint
- Update IMPLEMENTATION_PLAN.md (check off tasks) and PROGRESS.md.

## Hard acceptance criteria (must ship)
- Storefront + Cart + Checkout (COD) + Orders in DB + Admin CRUD
- CSV import/export workflow (no scraping)
- Homepage Room Power-Up animation (short + skippable + reduced motion)
- Hostinger deployment doc with exact steps

Only when everything in specs/PRD.md is satisfied, output exactly:
<promise>BUILD_COMPLETE</promise>