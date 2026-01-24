# Student Management System

A simple PHP-based Student Management System with MySQL database.

## Features
- Admin login to manage students and teachers
- Student login to view profile
- Teacher management (add, view, update, delete)
- Student management (add, view, update, delete)
- Admission form for new students
- Dashboard for admins and students

## Setup Instructions

1. **Install XAMPP**: Make sure XAMPP is installed on your system (Apache and MySQL).

2. **Start XAMPP Services**:
   - Open XAMPP Control Panel.
   - Start Apache and MySQL.

3. **Database Setup**:
   - Open phpMyAdmin (usually at http://localhost/phpmyadmin).
   - Create a new database named `schoolproject`.
   - Alternatively, run the `setup.sql` file in phpMyAdmin or via command line:
     ```
     mysql -u root -p < setup.sql
     ```
     (Enter password when prompted: Rkaviya@123)

4. **Place Files**:
   - Ensure all PHP files are in `c:\xampp\htdocs\studentmanagementsystem\`.
   - Create the `image/` folder and add teacher images if needed.

5. **Access the Application**:
   - Open browser and go to `http://localhost/studentmanagementsystem/`.
   - Login as admin: username `admin`, password `admin123`.
   - Login as student: username `student1`, password `student123`.

## Database Tables
- `user`: Stores user accounts (admins and students).
- `teacher`: Stores teacher information.
- `admission`: Stores admission applications.

## Technologies Used
- PHP
- MySQL
- Bootstrap 5
- HTML/CSS

## Notes
- Default admin credentials: admin / admin123
- Passwords are stored in plain text (not recommended for production).
- Add images to the `image/` folder for teachers.