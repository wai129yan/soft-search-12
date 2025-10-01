# Product Management System

A simple web application built with Laravel for managing products, including CRUD operations, soft deletes, search, and pagination.

## Overview

This project is a product inventory system where users can create, view, edit, delete, restore, and permanently delete products. Products are associated with categories and support image uploads. It uses Laravel's Eloquent ORM, soft deletes, and Blade templating.

## Features

- **Product CRUD**: Create, read, update, and delete products with validation.
- **Soft Deletes**: Temporarily delete products and view them in a trash list with search and pagination.
- **Restore and Permanent Delete**: Restore soft-deleted products or delete them permanently, including associated images.
- **Search and Filter**: Search products by name, description, status, or category name; optional filter by status.
- **Pagination**: Paginated lists for active and trashed products (10 per page).
- **Image Upload**: Upload and manage product images stored in the public disk.
- **Category Association**: Products linked to categories via foreign key (basic category model included).

## Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10
- A database (e.g., MySQL, SQLite)
- Node.js and npm (for asset compilation with Vite)

## Installation

1. Clone the repository:
   ```
   git clone <your-repo-url>
   cd soft-search-12
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install JS dependencies:
   ```
   npm install
   ```

4. Copy environment file and configure (update database settings in .env):
   ```
   cp .env.example .env
   ```

5. Generate application key:
   ```
   php artisan key:generate
   ```

6. Run database migrations:
   ```
   php artisan migrate
   ```

7. (Optional) Seed the database if seeders are set up:
   ```
   php artisan db:seed
   ```

8. Compile assets:
   ```
   npm run dev
   ```

9. Start the development server:
   ```
   php artisan serve
   ```

The application will be available at `http://localhost:8000`.

## Usage

- **View All Products**: Navigate to `/products` – supports search (?search=term) and pagination.
- **Create Product**: Go to `/create-product` to add a new product with category selection and image upload.
- **View Single Product**: `/show-product/{id}`
- **Edit Product**: `/edit-product/{id}`
- **Delete Product** (Soft): Use the delete action on product list – moves to trash.
- **View Trashed Products**: `/deleted-products` – supports search and pagination; restore or permanently delete from here.

For detailed routes, check `routes/web.php`. All operations include success messages via redirects.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your changes.

---

## Laravel Framework Information

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
