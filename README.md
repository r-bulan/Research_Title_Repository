# CCS Research Title Repository

A comprehensive Laravel-based web application for managing research titles in the College of Computer Studies (CCS). This system is designed specifically for CCS research management with features for CRUD operations, file uploads, soft deletes, PDF exports, and more.

## Features

### ✅ Core Functionality
- **Dashboard**: Real-time statistics (Total, Active, Trashed titles)
- **Research Titles CRUD**: Create, Read, Update, Delete operations
- **Categories Management**: Organize research titles by CCS categories
- **Soft Delete & Trash**: Temporarily delete and restore items
- **User Authentication**: Secure login and registration system

### 📸 File Management
- **Photo Upload**: Upload author photos (JPG/PNG, max 2MB)
- **Avatar Display**: Shows uploaded photo or author initials
- **Storage**: Files saved in `storage/app/public/research_photos`

### 🔍 Search & Filter
- **Advanced Search**: Search by title, author name, or email
- **Category Filtering**: Filter by CCS research categories
- **Clear Filters**: One-click reset of all filters
- **Persistent Filters**: Query parameters maintained on page reload

### 📄 Export Functionality
- **PDF Export**: One-click export of research titles
- **Filtered Export**: Exports only current filtered results
- **Professional Layout**: Includes header, summary, table, and footer
- **Automatic Naming**: Format: `ccs_research_titles_YYYYMMDD_HHMMSS.pdf`

### 📱 Responsiveness
- **Mobile Optimized**: Hamburger menu on small screens
- **Tablet Support**: Adaptive layout for all devices
- **Desktop Ready**: Full-featured experience on large screens
- **Touch Friendly**: Optimized buttons and forms

### 🔔 User Feedback
- **Flash Messages**: Success, error, and validation messages
- **Auto-Dismiss**: Success alerts auto-dismiss after 5 seconds
- **Confirmation Dialogs**: Destructive actions require confirmation
- **Loading States**: Smooth animations and transitions

## Tech Stack

- **Backend**: Laravel 12 (Latest)
- **Frontend**: Tailwind CSS
- **Database**: MySQL
- **PDF Library**: barryvdh/laravel-dompdf
- **Authentication**: Laravel Sanctum + Jetstream

## Installation

### Requirements
- PHP 8.2+
- MySQL 5.7+
- Composer
- Node.js (optional, for asset compilation)

### Setup Steps

1. **Clone/Download Project**
```bash
cd c:\xampp\htdocs\research_title_repository
```

2. **Install Dependencies**
```bash
composer install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
Edit `.env` file:
```
DB_DATABASE=research_title_repository
DB_USERNAME=root
DB_PASSWORD=
```

5. **Create Database**
```bash
mysql -u root
CREATE DATABASE research_title_repository;
EXIT;
```

6. **Run Migrations & Seeders**
```bash
php artisan migrate:fresh --seed
```

7. **Storage Link**
```bash
php artisan storage:link
```

8. **Install PDF Package** (if not already installed)
```bash
composer require barryvdh/laravel-dompdf
```

9. **Start Development Server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Usage

### Default Login
- **Email**: user@example.com
- **Password**: password

### Navigation
- **📊 Dashboard**: View statistics
- **📚 Research Titles**: Manage CCS research titles
- **📂 Categories**: Organize research categories
- **🗑️ Trash**: View and restore deleted items

### Creating Research Title
1. Click "**+ Add Research Title**"
2. Fill in required fields (Title, Author, Email, Category)
3. Optionally upload author photo (JPG/PNG, max 2MB)
4. Click "Create Research Title"

### Editing Research Title
1. Click "Edit" next to research title
2. Modify fields as needed
3. Update photo if desired
4. Click "Update Research Title"

### Deleting Research Title
1. Click "Delete" next to research title
2. Confirm deletion in dialog
3. Item moves to Trash
4. Go to Trash to restore or permanently delete

### Exporting to PDF
1. Apply filters/search if desired (optional)
2. Click "📄 Export PDF" button
3. PDF downloads with filtered results

## Database Schema

### Categories Table
- `id`: Primary key
- `name`: Category name (unique)
- `created_at`, `updated_at`: Timestamps

### Research Titles Table
- `id`: Primary key
- `title`: Research title (unique)
- `author_name`: Author name
- `email`: Author email
- `category_id`: Foreign key to categories
- `photo`: Photo filename (nullable)
- `created_at`, `updated_at`: Timestamps
- `deleted_at`: Soft delete timestamp

## Project Structure

```
research_title_repository/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── ResearchTitleController.php
│   │   │   └── CategoryController.php
│   │   └── Requests/
│   │       ├── StoreResearchTitleRequest.php
│   │       └── UpdateResearchTitleRequest.php
│   └── Models/
│       ├── ResearchTitle.php
│       └── Category.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── CategorySeeder.php
│       └── ResearchTitleSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard.blade.php
│       ├── research_titles/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── show.blade.php
│       │   ├── trash.blade.php
│       │   └── export_pdf.blade.php
│       └── categories/
│           ├── index.blade.php
│           ├── create.blade.php
│           └── edit.blade.php
├── routes/
│   └── web.php
└── storage/
    └── app/
        └── public/
            └── research_photos/
```

## Common Issues & Solutions

### 404 Error on Export
**Solution**: Ensure export route is defined before resource route in `routes/web.php`

### Photo Upload Not Working
**Solution**: Run `php artisan storage:link` to create storage symlink

### Database Connection Error
**Solution**: Check `.env` file database credentials and ensure MySQL is running

### Class Not Found Error
**Solution**: Run `composer dump-autoload` and `php artisan cache:clear`

### View Not Found
**Solution**: Run `php artisan view:clear` and check view file paths

## Demo Data

The seeder creates:
- ✅ 4 CCS research categories
- ✅ 11 active research titles
- ✅ 3 soft-deleted research titles
- ✅ All CCS-focused and technology-related

Run `php artisan migrate:fresh --seed` to regenerate demo data.

## Features Checklist

- ✅ Dashboard with statistics
- ✅ Research Titles CRUD
- ✅ Categories Management
- ✅ Photo Upload with Validation
- ✅ Avatar Display (Photo or Initials)
- ✅ Search & Filter
- ✅ Soft Delete & Trash
- ✅ Restore & Permanent Delete
- ✅ PDF Export with Filtering
- ✅ Flash Messages & Confirmations
- ✅ Mobile Responsive Design
- ✅ Professional UI with Tailwind CSS
- ✅ Form Validation
- ✅ User Authentication
- ✅ Sidebar Navigation

## Security Features

- ✅ CSRF Token Protection
- ✅ SQL Injection Prevention
- ✅ XSS Protection
- ✅ File Upload Validation
- ✅ Authentication & Authorization
- ✅ Safe Query Building

## Performance Tips

- Use pagination (default: 10 items per page)
- Apply filters to reduce PDF file size
- Clear cache regularly: `php artisan cache:clear`
- Optimize images before upload
- Use Chrome DevTools for debugging

## Support & Issues

For issues or questions:
1. Check this README
2. Review error messages carefully
3. Check Laravel logs: `storage/logs/`
4. Run `php artisan cache:clear && php artisan view:clear`

## License

This project is part of the CCS final project requirements and is for educational purposes.

## Authors

College of Computer Studies - Final Project
Development completed: 2024

---

**Ready for Demo!** 🚀

Visit http://localhost:8000 and explore the CCS Research Title Repository system.