# Syrian Directory

A web directory application built with Laravel to manage and browse listings and services in Syria.

## About the Project
Syrian Directory is a comprehensive web-based platform designed to organize and list various services, businesses, and resources.

## Prerequisites
Before you begin, ensure you have the following installed on your local machine:
- PHP >= 8.2
- Composer
- XAMPP / MySQL

## Installation & Setup Guide
Follow these steps to run the project locally on your machine:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/AbuIssa-SmartSystems/syrian-directory.git](https://github.com/AbuIssa-SmartSystems/syrian-directory.git)
   Navigate to the project directory:

Bash
cd syrian-directory
Install PHP dependencies:

Bash
composer install
Configure the environment file:
Copy the example environment file and rename it to .env:

Bash
copy .env.example .env
Generate the application key:

Bash
php artisan key:generate
Run database migrations:

Bash
php artisan migrate
Start the local development server:

Bash
php artisan serve
License
The Laravel framework is open-sourced software licensed under the MIT license.
