# Analytics Dashboard

A modern, headless analytics dashboard API built with Laravel 12 and Vite. This application provides a RESTful API for managing analytics data and metrics without frontend Blade templates.

## Features

- **RESTful API** for analytics and metrics management
- **Laravel 12** framework with modern PHP 8.2+
- **Vite** for fast frontend bundling and development
- **Tailwind CSS** for responsive styling
- **SQLite** database (configurable to other databases)
- **Queue system** for background job processing
- **Session management** with database driver
- **Comprehensive testing** with PHPUnit

## Tech Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Vite, Tailwind CSS 4
- **Database**: SQLite (default), supports PostgreSQL, MySQL, etc.
- **Queue**: Database-backed queue system
- **Testing**: PHPUnit
- **Development Tools**: Laravel Sail, Laravel Pint, Faker, Collision

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- SQLite (included with most systems) or preferred database

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd dashboard-app
   ```

2. **Run the setup script**
   ```bash
   composer run setup
   ```
   
   This will:
   - Install PHP dependencies
   - Copy `.env.example` to `.env`
   - Generate application key
   - Run database migrations
   - Install Node.js dependencies
   - Build frontend assets

3. **Verify installation**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` to confirm the API is running.

## Quick Start

### Start Development Environment

Run all development services with a single command:

```bash
composer run dev
```

This concurrently starts:
- Laravel development server (port 8000)
- Queue listener for background jobs
- Log viewer (Pail)
- Vite development server for frontend bundling

### Build for Production

```bash
npm run build
```

### Run Tests

```bash
composer run test
```

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── AnalyticsController.php
│       └── MetricController.php
├── Models/
└── Providers/

database/
├── migrations/
├── factories/
└── seeders/

resources/
└── [Frontend assets]

routes/
├── web.php          # API routes
└── console.php      # Artisan commands

config/              # Application configuration
storage/             # Logs, sessions, cache
tests/               # PHPUnit tests
```

## API Endpoints

### Analytics
- `GET /` - Welcome endpoint
- `GET /api/analytics` - List all analytics
- `POST /api/analytics` - Create new analytics
- `GET /api/analytics/{id}` - Get specific analytics
- `PUT /api/analytics/{id}` - Update analytics
- `DELETE /api/analytics/{id}` - Delete analytics
- `GET /api/analytics/stats` - Get analytics statistics

### Metrics
- `GET /api/metrics` - List all metrics
- `POST /api/metrics` - Create new metric
- `GET /api/metrics/{id}` - Get specific metric
- `PUT /api/metrics/{id}` - Update metric
- `DELETE /api/metrics/{id}` - Delete metric
- `GET /api/metrics/category/{category}` - Get metrics by category
- `GET /api/metrics/summary` - Get metrics summary

## Configuration

### Environment Variables

Key configuration options in `.env`:

```env
APP_NAME=Laravel                    # Application name
APP_ENV=local                       # Environment (local, production)
APP_DEBUG=true                      # Debug mode
APP_URL=http://localhost            # Application URL

DB_CONNECTION=sqlite                # Database driver
# DB_DATABASE=database.sqlite       # Database file path (SQLite)

SESSION_DRIVER=database             # Session storage
QUEUE_CONNECTION=database           # Queue driver
CACHE_STORE=database               # Cache driver

MAIL_MAILER=log                     # Mail driver
```

### Database Configuration

Default configuration uses SQLite. To use MySQL or PostgreSQL:

1. Update `DB_CONNECTION` in `.env`
2. Set appropriate `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
3. Run migrations: `php artisan migrate`

## Development

### Code Formatting

Uses Laravel Pint for PHP code style:

```bash
./vendor/bin/pint
```

### Database Migrations

Create a new migration:
```bash
php artisan make:migration create_analytics_table
```

Run migrations:
```bash
php artisan migrate
```

Rollback migrations:
```bash
php artisan migrate:rollback
```

### Database Seeding

Create a seeder:
```bash
php artisan make:seeder AnalyticsSeeder
```

Run seeders:
```bash
php artisan db:seed
```

### Queue Processing

Listen for queued jobs:
```bash
php artisan queue:listen
```

### Debugging

View real-time logs:
```bash
php artisan pail
```

## Testing

Run all tests:
```bash
composer run test
```

Run specific test file:
```bash
php artisan test tests/Unit/ExampleTest.php
```

Run tests with coverage:
```bash
php artisan test --coverage
```

## Deployment

1. **Build assets**
   ```bash
   npm run build
   ```

2. **Install dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Set environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

5. **Cache configuration** (recommended)
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Useful Commands

```bash
# Generate application key
php artisan key:generate

# Tinker REPL (interactive shell)
php artisan tinker

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

# Database management
php artisan migrate:fresh --seed      # Reset database with seeders
php artisan migrate:refresh           # Rollback and re-run migrations

# API documentation
php artisan route:list                # Show all routes
```

## Troubleshooting

### Database not found
Ensure the SQLite database file exists:
```bash
touch database/database.sqlite
php artisan migrate
```

### Port already in use
Change the port for the development server:
```bash
php artisan serve --port=8001
```

### Node modules issues
Clear and reinstall:
```bash
rm -rf node_modules package-lock.json
npm install
```

### Vite hot module reload not working
Ensure Vite server is running with `npm run dev` or use `composer run dev`.

## License

This project is open-source software licensed under the [MIT license](LICENSE).

## Support

For issues and questions, please open an issue in the repository.
