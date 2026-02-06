# Laravel Course Management System

A robust Learning Management System (LMS) built with Laravel 11. This application allows administrators to manage video courses and episodes, while providing a clean interface for users to browse and view content. It includes a fully functional REST API and Role-Based Access Control (RBAC).

## 🚀 Features

### User & Authentication

- **Secure Authentication:** Powered by Laravel Breeze (Login, Registration, Password Reset, Email Verification).
- **Role-Based Access Control:** Distinct `admin` and `user` roles.
- **Profile Management:** Users can update profile information and change passwords.

### Course Management (Admin)

- **Admin Dashboard:** Dedicated area for content management protected by middleware.
- **Course CRUD:** Create, Read, Update, and Delete courses.
- **Episode Management:** Add multiple video episodes to specific courses.
- **Publishing Workflow:** Draft/Publish toggle for courses (visible/hidden from public).

### Public Interface

- **Course Catalog:** Browse available published courses.
- **Course Details:** View course metadata and associated episodes.

### Developer Features

- **REST API:** JSON endpoints for consuming course data externally (Mobile App/SPA).
- **Testing:** Comprehensive feature and unit tests using **Pest**.
- **Modern Frontend:** Built with **Tailwind CSS** and **Vite**.

---

## 🛠 Tech Stack

- **Backend:** PHP 8.2+, Laravel 11
- **Database:** MySQL
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Build Tool:** Vite
- **Testing:** Pest / PHPUnit
- **API Authentication:** Laravel Sanctum

---

## ⚙️ Prerequisites

Before you begin, ensure you have the following installed on your local machine:

- [PHP](https://www.php.net/downloads) (v8.2 or higher)
- [Composer](https://getcomposer.org/)
- [Node.js & NPM](https://nodejs.org/)
- [MySQL](https://www.mysql.com/)

---

## 📥 Installation

1. **Clone the repository**

```bash
git clone https://github.com/faraj2003/laravel_project_1.git
cd laravel_project_1

```

2. **Install PHP dependencies**

```bash
composer install

```

3. **Install and compile frontend assets**

```bash
npm install
npm run build

```

4. **Environment Configuration**
   Copy the example environment file and configure your database credentials.

```bash
cp .env.example .env

```

Open `.env` and update the database settings:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

```

5. **Generate Application Key**

```bash
php artisan key:generate

```

6. **Run Migrations & Seeders**
   Create the database tables and populate them with dummy data (users, courses, episodes).

```bash
php artisan migrate --seed

```

---

## 🖥 Usage

### Running the Server

Start the local development server:

```bash
php artisan serve

```

Access the application at `http://localhost:8000`.

### Accessing the Admin Panel

To access the admin features, you must log in as a user with the `admin` role.

1. Register a new account via the UI.
2. Manually update your user role in the database:

```sql
UPDATE users SET role = 'admin' WHERE email = 'your-email@example.com';

```

_(Alternatively, check `database/seeders/DatabaseSeeder.php` to see if a default admin is created automatically)._ 3. Once logged in as an admin, navigate to the Dashboard or specific Admin routes (e.g., `/admin/courses`).

---

## 🔗 API Documentation

The application exposes endpoints for accessing course data.

| Method | Endpoint            | Description                       |
| ------ | ------------------- | --------------------------------- |
| `GET`  | `/api/courses`      | List all published courses.       |
| `GET`  | `/api/courses/{id}` | Get details of a specific course. |

_Check `routes/api.php` and `app/Http/Controllers/Api/CourseController.php` for more details._

---

## 🧪 Testing

This project uses **Pest** for testing. To run the test suite:

```bash
# Run all tests
php artisan test

# OR directly via Pest
./vendor/bin/pest

```

Tests cover:

- Authentication flows (Login, Registration).
- Profile updates.
- Admin middleware protection.
- Course creation and public visibility.

---

## 📂 Project Structure Overview

```text
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin       # Admin-only logic (Course management)
│   │   │   ├── Api         # API logic
│   │   │   └── Auth        # Authentication logic
│   │   ├── Middleware      # AdminMiddleware.php (Role checks)
│   │   └── Requests        # Form Validation (StoreCourseRequest, etc.)
│   └── Models              # User, Course, Episode
├── database
│   ├── migrations          # DB Schema definitions
│   └── seeders             # Dummy data generators
├── resources
│   └── views
│       ├── admin           # Admin Blade templates
│       ├── courses         # Public Course templates
│       └── components      # Reusable Blade components
├── routes
│   ├── api.php             # API Routes
│   └── web.php             # Web Routes
└── tests                   # Feature and Unit tests

```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
