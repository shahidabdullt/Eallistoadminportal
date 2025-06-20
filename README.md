# Eallisto Admin Portal

This is a Laravel 12-based admin portal built as an assignment project for **Eallisto**. It provides basic authentication and CRUD functionality for managing **Customers** and **Invoices**. The application also supports a single API endpoint to handle both **listing** and **creation** of records based on type.

## Features

- Admin login and authentication
- Customer management (Create, List,Edit)
- Invoice management (Create, List,Edit)
- Unified API endpoint for both Customers and Invoices

## Requirements

- PHP >= 8.2
- Laravel 12
- Composer
- MySQL or any other supported database


## Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/shahidabdullt/Eallistoadminportal.git
cd Eallistoadminportal

install dependencies

composer install

Set Up Environment File
Copy the .env.example to .env:
Update the .env file with your database and mail configuration.
Generate Application Key
php artisan key:generate
Run Migrations and Seeders
php artisan migrate --seed
This will set up the necessary tables and  seed a default admin user.
Start the Development Server
php artisan serve

login credentails
sha
12345678

Visit http://localhost:8000 to access the application.

You can use the seeded admin credentials or seed a new admin registration is not added to this application

can also refer uploaded video to how to use the application
can refer laravel documentation also
