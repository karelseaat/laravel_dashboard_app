# Analytics Dashboard API

I built this because I needed a simple, headless analytics API—no Blade templates, no CMS bloat. Just JSON endpoints for analytics and metrics, served fast.

## What It Does

- REST API for managing analytics events and metrics  
- Backed by Laravel 12 + PHP 8.2+  
- Vite + Tailwind CSS for frontend bundling (still included, since we ship some JS for dashboards or integrations)  
- SQLite by default, but swapping to PostgreSQL or MySQL is trivial  
- Uses database-backed queues (no Redis needed)  
- All tests pass with PHPUnit  

No magic. No over-engineering.

## Prerequisites

- PHP 8.2+  
- Composer  
- Node 18+  
- SQLite (bundled with most PHP installs) or MySQL/PostgreSQL  

## Install

```bash
git clone <repository-url>
cd dashboard-app
composer run setup
php artisan serve
```

`composer run setup` handles dependencies, `.env`, key generation, migrations, and frontend builds.

## Run Development

```bash
composer run dev
```

Starts:
- Laravel dev server (port 8000)  
- Queue listener  
- Pail log viewer  
- Vite HMR  

Build for production:

```bash
npm run build
```

Run tests:

```bash
composer run test
```

## Structure

```
app/
├── Http/Controllers/
│   ├── AnalyticsController.php
│   └── MetricController.php
├── Models/
└── Providers/

database/
├── migrations/
├── factories/
└── seeders/

resources/
└── [Vite entrypoints]

routes/
├── web.php       # API routes only
└── console.php   # CLI commands
```

## Endpoints

**Analytics**  
`GET /` — Welcome  
`GET|POST /api/analytics`  
`GET|PUT|DELETE /api/analytics/{id}`  
`GET /api/analytics/stats`

**Metrics**  
`GET|POST /api/metrics`  
`GET|PUT|DELETE /api/metrics/{id}`  
`GET /api/metrics/category/{category}`  
`GET /api/metrics/summary`

Full list available via `php artisan route:list`.

## Config

`.env` keys you’ll care about:

```env
DB_CONNECTION=sqlite              # change to mysql/pgsql
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

To switch databases: update `DB_*` vars, run `php artisan migrate`.

## dev workflow

- Format PHP: `./vendor/bin/pint`  
- Migrations: `php artisan make:migration && php artisan migrate`  
- Seed data: `php artisan make:seeder && php artisan db:seed`  
- Queue: `php artisan queue:listen`  
- Logs: `php artisan pail`  

## Deploy

1. `npm run build`  
2. `composer install --optimize-autoloader --no-dev`  
3. `cp .env.example .env && php artisan key:generate`  
4. `php artisan migrate --force`  
5. Cache: `php artisan config:cache && php artisan route:cache`

## Gotchas

- SQLite? Make sure `database/database.sqlite` exists before first migrate  
- Port 8000 taken? `php artisan serve --port=8001`  
- Node modules acting up? `rm -rf node_modules && npm install`  
- Vite HMR not hot? Make sure Vite is running (`composer run dev`)

---

MIT license. Issues welcome.

## More from Karelseaat

For more projects and experiments, visit my GitHub Pages site: [karelseaat.github.io](https://karelseaat.github.io/)
