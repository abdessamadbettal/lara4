![Lara4](.github/screenshots/home.png)

# 🚀 Lara4 - Laravel Inertia Vue Starter

**A powerful Laravel starter kit designed for speed, simplicity, and modern development.**

Lara4 is the perfect starting point for Laravel developers looking for an optimized, feature-rich foundation. It integrates **Inertia.js** with **Vue 3**, offers **multi-language support**, **SEO-friendly features**, **SSR**, and **Filament Admin Panel** for seamless content management. Pre-configured with essential packages, Lara4 saves you time and effort in setting up your next Laravel project. 

---

## 🌟 Features

### 🔧 Development Tools
- **Laravel 11 + Vue 3 + Inertia.js**
- **Tailwind CSS** for modern UI styling
- **Server-Side Rendering (SSR)** for better performance
- **Filament Admin Panel** with user management, settings, activity log, and translations
- **SEO Optimized** with meta tags, sitemap, and structured data
- **Multi-language support (EN, FR, ES, AR)** with Vue i18n
- **Docker & Laravel Sail** for easy local development
- **Mailpit** for email testing
- **MySQL + PhpMyAdmin** for database management
- **Redis** for caching
- **Ziggy** for seamless frontend-backend routing

### 🔐 Authentication & Security
- **Laravel Breeze** authentication setup
- **Social login with Google & GitHub (Laravel Socialite)**
- **Spatie Laravel Permission** for role-based access control
- **Activity Log** to track user actions

### 📦 Pre-Installed Packages
- **Spatie Media Library** for managing file uploads
- **Spatie Settings** for application-wide settings
- **Spatie Laravel Tags** for content tagging
- **Spatie Laravel Backup** for automated backups
- **Spatie Laravel Sluggable** for automatic URL slugs
- **Spatie Laravel Translatable** for multi-language content
- **Laravel Debugbar & Telescope** for debugging
- **Laravel Seo** for enhanced search engine visibility
- **Laravel Enum** support for better code structure
- **TestMonitor Vue i18n Generator** for seamless frontend translation

---

## 🛠️ Installation

### Prerequisites
- **Docker (for Laravel Sail users)**
- **PHP 8.2 or higher**
- **Composer**
- **Node.js & npm**

### Setup Guide
1. **Clone the repository:**
   ```sh
   git clone https://github.com/abdessamadbettal/Lara4.git
   cd Lara4
   ```
2. **Copy environment file and configure it:**
   ```sh
   cp .env.example .env
   ```
3. **Install dependencies:**
   ```sh
   composer install
   npm install
   ```
4. **Generate application key:**
   ```sh
   php artisan key:generate
   ```
5. **Start Docker containers (if using Sail):**
   ```sh
   sail up -d
   ```
6. **Run migrations with seeders:**
   ```sh
   php artisan migrate:fresh --seed
   ```
7. **Compile Vue i18n translations:**
   ```sh
   php artisan vue:translations
   ```
8. **Run tests:**
   ```sh
   php artisan test   # or sail test
   ```
9. **Dump autoload for optimized performance:**
   ```sh
   composer dump-autoload
   ```
10. **Generate enums:**
    ```sh
    php artisan make:spatie-enum StatusEnum
    ```
11. **Create services:**
    ```sh
    php artisan make:service UserService
    ```
12. **Generate request validation classes:**
    ```sh
    php artisan make:request User/UpdateUserRequest
    php artisan make:request User/StoreUserRequest
    ```

---

## 🔗 Usage

- **Application:** [http://localhost](http://localhost)
- **PhpMyAdmin:** [http://localhost:8080](http://localhost:8080)
- **Mailpit:** [http://localhost:8025](http://localhost:8025)
- **Admin Panel:** [http://localhost/admin](http://localhost/admin)

### 🛡️ Default Admin Credentials
- **Email:** `admin@example.com`
- **Password:** `password`

---

## 💡 Contributing
We welcome contributions! Feel free to **submit issues** or **pull requests** to improve Lara4.

---

## 📜 License
This project is open-sourced software licensed under the [MIT license](LICENSE).

---

💻 **GitHub Repository:** [https://github.com/abdessamadbettal/Lara4](https://github.com/abdessamadbettal/Lara4)  
🌍 **Official Website:** [https://lara4.com](https://lara4.com)

