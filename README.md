# College Event Management System# College Event Management System<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



A comprehensive Laravel-based event management system for colleges and universities.



## 🚀 FeaturesA comprehensive Laravel-based event management system for colleges and universities.<p align="center">



- Multi-Role Support (Admin, Organizer, Student)<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>

- Event Management System

- Student Registration System## Features<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>

- Real-time Livewire Components

- Email Notifications<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>

- Feedback & Results Management

- Responsive Design- **Multi-Role Support**: Admin, Organizer, and Student roles<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>



## 📋 Requirements- **Event Management**: Create, manage, and track events</p>



- PHP >= 8.2- **Registration System**: Easy event registration for students

- Composer

- MySQL/PostgreSQL- **Real-time Updates**: Live notifications and announcements## About Laravel

- Node.js & NPM

- **Feedback System**: Collect feedback from participants

## 🛠️ Installation

- **Results Management**: Publish and manage event resultsLaravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

```bash

cd D:\college-event-management- **Email Notifications**: Automated email notifications

composer install

npm install- **Responsive Design**: Mobile-friendly interface- [Simple, fast routing engine](https://laravel.com/docs/routing).

cp .env.example .env

php artisan key:generate- [Powerful dependency injection container](https://laravel.com/docs/container).

php artisan migrate

php artisan storage:link## Requirements- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.

npm run dev

php artisan serve- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).

```

- PHP >= 8.1- Database agnostic [schema migrations](https://laravel.com/docs/migrations).

## 📁 Project Structure Created

- Composer- [Robust background job processing](https://laravel.com/docs/queues).

✅ Controllers: EventController, FeedbackController, AnnouncementController, ResultController

✅ Models: User, Role, Event, Registration, Feedback, Announcement, Result- MySQL/PostgreSQL- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

✅ Livewire Components: EventList, ParticipantTable, DashboardStats, NotificationPanel

✅ Mail Classes: EventRegisteredMail, AnnouncementMail- Node.js & NPM

✅ Views: Admin, Organizer, Student, Auth, Pages, Layouts, Components

✅ Routes: admin.php, organizer.php, student.phpLaravel is accessible, powerful, and provides tools required for large, robust applications.

✅ Assets: CSS (style.css, dashboard.css, responsive.css), JS files

## Installation

## 👥 User Roles

## Learning Laravel

- **Admin**: Full system management

- **Organizer**: Event creation and management1. Clone the repository or navigate to the project directory:

- **Student**: Browse and register for events

```bashLaravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## 📞 Next Steps

cd D:\college-event-management

1. Configure database in .env

2. Run migrations: `php artisan migrate````You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

3. Install Livewire: `composer require livewire/livewire`

4. Install Spatie Permissions: `composer require spatie/laravel-permission`

5. Set up authentication: `composer require laravel/ui`

2. Install PHP dependencies:If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

---

```bash

© 2025 College Event Management System

composer install## Laravel Sponsors

```

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

3. Install JavaScript dependencies:

```bash### Premium Partners

npm install

```- **[Vehikl](https://vehikl.com)**

- **[Tighten Co.](https://tighten.co)**

4. Create a copy of the .env file:- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**

```bash- **[64 Robots](https://64robots.com)**

cp .env.example .env- **[Curotec](https://www.curotec.com/services/technologies/laravel)**

```- **[DevSquad](https://devsquad.com/hire-laravel-developers)**

- **[Redberry](https://redberry.international/laravel-development)**

5. Generate application key:- **[Active Logic](https://activelogic.com)**

```bash

php artisan key:generate## Contributing

```

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

6. Configure your database in the .env file:

```## Code of Conduct

DB_CONNECTION=mysql

DB_HOST=127.0.0.1In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

DB_PORT=3306

DB_DATABASE=college_event_management## Security Vulnerabilities

DB_USERNAME=root

DB_PASSWORD=If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

```

## License

7. Run database migrations:

```bashThe Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

php artisan migrate
```

8. Seed the database (optional):
```bash
php artisan db:seed
```

9. Create storage link:
```bash
php artisan storage:link
```

10. Build assets:
```bash
npm run dev
```

11. Start the development server:
```bash
php artisan serve
```

Visit: http://localhost:8000

## Project Structure

```
college-event-management/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Controller files
│   │   ├── Livewire/         # Livewire components
│   │   └── Middleware/       # Custom middleware
│   ├── Mail/                 # Mailable classes
│   ├── Models/               # Eloquent models
│   └── Providers/            # Service providers
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/             # Database seeders
├── public/
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   └── images/              # Image assets
├── resources/
│   ├── views/               # Blade templates
│   │   ├── layouts/        # Layout templates
│   │   ├── components/     # Reusable components
│   │   ├── admin/          # Admin views
│   │   ├── organizer/      # Organizer views
│   │   ├── student/        # Student views
│   │   └── pages/          # Public pages
│   └── mail/               # Email templates
└── routes/
    ├── web.php             # Web routes
    ├── admin.php           # Admin routes
    ├── organizer.php       # Organizer routes
    └── student.php         # Student routes
```

## User Roles

### Admin
- Manage all events
- View all participants
- Publish results
- Create announcements
- System-wide control

### Organizer
- Create and manage own events
- View event registrations
- Manage event feedback
- Publish event results

### Student
- Browse available events
- Register for events
- Submit feedback
- View results

## Key Features Setup

### Livewire Integration
```bash
composer require livewire/livewire
```

### Spatie Permission Package
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

### Mail Configuration
Configure mail settings in `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Development

### Run development server:
```bash
php artisan serve
```

### Watch for asset changes:
```bash
npm run dev
```

### Run tests:
```bash
php artisan test
```

## Production Deployment

1. Set environment to production in .env:
```
APP_ENV=production
APP_DEBUG=false
```

2. Optimize the application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. Build production assets:
```bash
npm run build
```

## Security

- All routes are protected with authentication middleware
- Role-based access control using middleware
- CSRF protection enabled on all forms
- SQL injection prevention through Eloquent ORM
- XSS protection in Blade templates

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is open-sourced software licensed under the MIT license.

## Support

For support, email support@example.com or create an issue in the repository.

## Credits

Developed by [Your Name/Team]

---

© 2025 College Event Management System. All rights reserved.
#   c o l l e g e _ e v e n t _ m a n a g e m e n t  
 