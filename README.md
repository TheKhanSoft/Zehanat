# Zehanat — The KP Society for AI in Education

"Zehanat" (ذہانت) — meaning "intelligence" in Urdu — is the Khyber Pakhtunkhwa Society for AI in Education. Hosted by Abdul Wali Khan University Mardan (AWKUM), Zehanat is dedicated to helping schools, colleges, universities, and institutions understand Artificial Intelligence and use it responsibly in teaching, administration, and preparing the youth for the future.

This repository contains the source code for the public-facing website of Zehanat.

## Features

- **Modern UI/UX**: Designed with a premium, dark-themed aesthetic featuring glassmorphism and subtle animations.
- **Responsive Layout**: Fully responsive design that works seamlessly across desktops, tablets, and mobile devices.
- **Tailwind CSS v4**: Styled using the latest utility-first CSS framework.
- **Reusable Blade Components**: Modular architecture with 14+ reusable Laravel Blade components (buttons, cards, alerts, accordions, etc.) for easy maintenance and consistency.
- **Interactive Elements**: Features scroll-triggered animations, animated stat counters, and a neural-network inspired hero canvas.

## Tech Stack

- **Framework**: [Laravel 11.x](https://laravel.com/) (PHP 8.2+)
- **Frontend**: [Tailwind CSS v4](https://tailwindcss.com/)
- **Build Tool**: [Vite](https://vitejs.dev/)
- **Templating**: Laravel Blade
- **Authentication**: Laravel Fortify + Livewire
- **Roles & Permissions**: [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)

## Prerequisites

Before setting up the project, ensure you have the following installed on your system:

- PHP >= 8.2
- Composer
- Node.js & npm
- A web server (Apache/Nginx) or Laravel Herd / XAMPP
- Git

## Installation & Setup

Follow these steps to get the project up and running on your local machine:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/TheKhanSoft/Zehanat.git
   cd Zehanat
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies:**
   ```bash
   npm install
   ```

4. **Set up environment variables:**
   Copy the example environment file and create a new `.env` file.
   ```bash
   cp .env.example .env
   ```

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Configure Database (Optional for public site):**
   Update the `.env` file with your database credentials. Since this is primarily a static public-facing site currently, a database might not be strictly necessary unless you are using the authentication/dashboard features.
   ```env
   DB_CONNECTION=sqlite
   # OR for MySQL:
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=zehanat
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```
   If using a database, run migrations:
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets:**
   ```bash
   npm run build
   ```
   *For active development with hot-module replacement, use `npm run dev` instead.*

8. **Serve the application:**
   You can serve the application using Laravel's built-in development server:
   ```bash
   php artisan serve
   ```
   The site will be available at `http://localhost:8000`.

   *Note: On Windows, `php artisan serve` binds to IPv6 `::1` for localhost. If you specifically need IPv4 `127.0.0.1`, run `php artisan serve --host=0.0.0.0`.*

## Project Structure

The key directories and files customized for the public website:

- `routes/web.php`: Defines all public-facing routes (`/`, `/about`, `/pillars`, etc.).
- `resources/views/public/`: Contains the Blade templates for all public pages.
- `resources/views/layouts/public.blade.php`: The main layout wrapper for public pages.
- `resources/views/components/public/`: Contains all reusable UI components.
- `resources/css/public.css`: Custom styles, animations, and Tailwind directives.
- `resources/js/public.js`: Vanilla JavaScript for interactivity.
- `app/Livewire/Admin/` - Livewire component classes for the Admin Panel managers.
- `app/Models/` - Eloquent models (Member, Faq, NewsEvent, ContactMessage, EmailTemplate, etc.)
- `resources/views/livewire/admin/` - Admin panel Livewire views (Glassmorphism design).
- `resources/views/components/admin/` - Reusable admin UI components.
- `resources/views/emails/` - Email templates including managed dynamic templates.
- `resources/css/admin.css` - Admin panel styles.
- `app/Http/Middleware/AdminMiddleware.php` - Admin access control.

## Admin Panel

The Admin Panel has been rebuilt as a reactive, SPA-like interface using **Livewire 3**, featuring a modern dark-mode glassmorphism design.

- **Access**: Navigate to `/admin` after logging in.
- **Default Credentials**: Email: `admin@zehanat.org`, Password: `password` (change after first login)
- **Core Modules**:
  - **Dashboard**: Real-time statistics (members, messages, news).
  - **Member Management**: Approve/reject applications, organization validation, user impersonation, import/export.
  - **Knowledge Base (FAQ)**: Full CRUD with active/inactive toggles.
  - **News & Events**: Full CRUD with WYSIWYG support.
  - **Communications**: Contact messages and dynamic email template management.
- **Roles & Permissions (RBAC)**: Powered by [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission). The UI and backend dynamically adapt to granular permissions (e.g., `create members`, `delete faqs`). 
- **Security & Profile**: 
  - Integrated with **Laravel Fortify** for complete Profile Settings management.
  - **Two-Factor Authentication (2FA)** with QR code and Recovery Codes.
  - Email Verification enforcement (`MustVerifyEmail`).
  - Passkey and secure password management.
- **Email Notifications**: Members receive beautifully designed welcome emails and managed templates based on status changes.

## Development Guidelines

- **Adding New Pages**: 
  1. Create a new Blade view in `resources/views/public/`.
  2. Extend the layout: `@extends('layouts.public')`.
  3. Register the route in `routes/web.php`.
- **Modifying Styles**: Edit `resources/css/public.css` or use Tailwind utility classes directly in the Blade templates. Run `npm run dev` to watch for changes.
- **Components**: When building new UI elements, consider creating a reusable component in `resources/views/components/public/` to maintain consistency.

## Credits

Developed by **[Kashif Ahmad Khan](https://github.com/TheKhanSoft)** & **Dr. Muhammad Ilyas Khalil**, Directorate of IT, Abdul Wali Khan University Mardan.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
