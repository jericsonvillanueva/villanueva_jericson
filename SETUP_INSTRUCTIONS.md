# Student Management System with Authentication

A modern student management system built with LavaLust PHP Framework featuring user authentication, role-based access control, and profile management.

## Features

### Authentication System
- **User Registration**: Students can register with email, username, and password
- **User Login**: Secure login with username/password authentication
- **Password Security**: Passwords are hashed using PHP's `password_hash()` function
- **Session Management**: Secure session handling with LavaLust's session library

### Role-Based Access Control
- **Admin Role**: Full access to student management (create, edit, delete students)
- **Student Role**: View-only access to student directory
- **Profile Management**: Users can update their own profile information

### Profile Management
- **Profile Images**: Users can upload and update profile pictures
- **Profile Editing**: Update personal information (name, email, username)
- **Password Change**: Secure password change functionality
- **Image Storage**: Profile images stored in `public/uploads/` directory

### Student Management (Admin Only)
- **Create Students**: Add new students with authentication credentials
- **Edit Students**: Update student information and roles
- **Delete Students**: Soft delete functionality (preserves data integrity)
- **Student Directory**: View all students with profile images and roles

## Database Schema

### Students Table
```sql
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Auth Table
```sql
CREATE TABLE `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL DEFAULT 'student',
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Setup Instructions

### 1. Database Setup
1. Run the SQL script in `database_update.sql` to create/update your database schema
2. This will create the admin user:
   - **Username**: jericson
   - **Password**: admin123
   - **Email**: villanuevajericsonpascual29@gmail.com
   - **Role**: admin

### 2. Environment Configuration
1. Update `env.php` with your database credentials
2. Ensure `public/uploads/` directory exists and is writable
3. Configure your web server to point to the project root

### 3. LavaLust Configuration
- Soft delete is enabled (`config['soft_delete'] = TRUE`)
- Session management is configured
- File uploads are configured for profile images

## Usage

### For Students
1. **Registration**: Visit `/auth/register` to create a new account
2. **Login**: Use `/auth/login` to access the system
3. **Profile**: Access `/auth/profile` to update personal information
4. **Student Directory**: View all students at `/students` (read-only)

### For Admins
1. **Login**: Use admin credentials (jericson/admin123)
2. **Student Management**: Access `/students` for full CRUD operations
3. **Create Students**: Use "Add New Student" button to register new users
4. **Edit Students**: Click edit button to update student information
5. **Delete Students**: Soft delete students (data preserved)

## File Structure

```
app/
├── controllers/
│   ├── Auth.php          # Authentication controller
│   ├── Students.php      # Student management controller
│   └── Welcome.php       # Main landing page controller
├── models/
│   ├── Auth_model.php    # Authentication model
│   └── Student_model.php # Student model
├── views/
│   ├── auth/
│   │   ├── login.php     # Login form
│   │   ├── register.php  # Registration form
│   │   └── profile.php   # Profile management
│   └── students/
│       ├── index.php     # Student directory
│       ├── create.php    # Add student form
│       └── edit.php      # Edit student form
└── config/
    ├── routes.php        # Route definitions
    └── config.php       # Framework configuration
```

## Security Features

- **Password Hashing**: All passwords are securely hashed using PHP's `password_hash()`
- **Session Security**: Secure session management with fingerprint matching
- **Input Validation**: All user inputs are validated and sanitized
- **CSRF Protection**: Available but disabled by default (can be enabled in config)
- **Soft Deletes**: Data integrity preserved with soft delete functionality
- **Role-Based Access**: Strict role-based access control

## Deployment Notes

- **Render Deployment**: Project is configured for Render deployment
- **FreeSQLDatabase**: Compatible with FreeSQLDatabase (free plan)
- **File Uploads**: Profile images stored in `public/uploads/`
- **Environment Variables**: Database credentials via `env.php`

## Default Admin Account

- **Username**: jericson
- **Password**: admin123
- **Role**: admin
- **Email**: villanuevajericsonpascual29@gmail.com

## Technology Stack

- **Framework**: LavaLust 4.2.5
- **Database**: MySQL/MariaDB
- **Frontend**: Tailwind CSS + Font Awesome
- **PHP**: 7.4+ with password hashing support
- **File Upload**: LavaLust Upload library
