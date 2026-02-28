# Mini Booking

### Overview

This project is a mini booking hotels built using
Laravel 12.

It includes:

-   Web authentication using blade files
-   API authentication using Laravel Sanctum
-   Clean architecture (use Service and Repository)
-   Eloquent relationships
-   Form Request validation
-   API Resources
-   Search caching
-   rate limiting
-   Search Api Unit test
-   sample data in database seeder

The system supports hotel management, room management, and availability
search.

------------------------------------------------------------------------

## Installation

### 1. Clone repository

git clone https://github.com/ahmedsafroot/mini-booking.git

cd mini-booking

### 2. Install dependencies

composer install

### 3. Copy environment file

cp .env.example .env

### 4. Configure environment

Update the following variables in `.env`:

DEFAULT_ADMIN_NAME=Admin User\
DEFAULT_ADMIN_EMAIL=admin@example.com\
DEFAULT_ADMIN_PASSWORD=12345678

API_RATE_LIMIT=100\
API_RATE_MINUTES=1

Configure your database connection as needed.

### 5. Generate app key

php artisan key:generate

### 6. Run migrations & seed data

php artisan migrate --seed

This will:

-   Create default admin user
-   Create 10 sample hotels
-   Create from 1 to 6 rooms for each hotel

### 7. Run the application

php artisan serve

Web URL:

http://127.0.0.1:8000

------------------------------------------------------------------------

## Default Admin Credentials

Email: DEFAULT_ADMIN_EMAIL (from .env)\
Password: DEFAULT_ADMIN_PASSWORD (from .env)

------------------------------------------------------------------------

# Features

## Web

-   Login / Logout
-    Dashboard
-   Hotel Management
    -   List hotels
    -   Filter by city
    -   Pagination
    -   Add hotel
-   Room Management
    -   Add room
    -   List rooms
-   Search Page
    -   Search by city
    -   Check-in / Check-out
    -   Guests
    -   Shows total calculated price

------------------------------------------------------------------------

## API (Sanctum)

All protected routes require:

Authorization: Bearer {token}

### Authentication

POST /api/login\
POST /api/logout

### Hotels

POST /api/hotels\
GET /api/hotels?city=&rating=&page=

### Rooms

POST /api/rooms

### Search

GET /api/search?city=&checkin_date=&checkout_date=&guests=

Response includes:

-   Hotel details
-   Available rooms
-   Total calculated price

------------------------------------------------------------------------


# Rate Limiting

Rate limits are configurable via `.env`:

API_RATE_LIMIT=100\
API_RATE_MINUTES=1

The limiter is applied using a named throttle:

throttle:api_rate_limit

It limits per authenticated user (or IP if guest).

------------------------------------------------------------------------

# Caching

Search results are cached for 5 minutes.

Cache driver is configurable via:

CACHE_Store=file

can make 5 configured on env file or settings table

------------------------------------------------------------------------

# Testing

Testing uses `.env.testing`.

Database is in-memory SQLite:

DB_CONNECTION=sqlite\
DB_DATABASE=:memory:

To run tests:

php artisan test

