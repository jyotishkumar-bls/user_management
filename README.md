# Student Management System

## Overview
This is a PHP-based web application for managing students in an educational institution. It features user authentication with role-based access (Admin, Staff, Student), student CRUD operations, file uploads for profile images, and MySQL database integration. The system is built using PHP, MySQL, Bootstrap for UI, and follows basic web development practices.

## Features
- **User Authentication**: Login and signup with role-based redirection.
- **Role-Based Access**:
  - **Admin**: Add, edit, delete, and view students; manage profiles.
  - **Staff**: Access to staff dashboard.
  - **Student**: Access to student dashboard.
- **Student Management**: CRUD operations for student records, including profile image uploads.
- **File Uploads**: Secure image uploads with validation (type, size).
- **Database Integration**: MySQL with prepared statements for security.
- **Session Management**: PHP sessions for user state.

## Project Structure
```
config/
    database.php          # Database connection configuration
profile/
    admin/
        add_student.php   # Add new student form
        dashboard.php     # Admin dashboard
        delete_student.php # Delete student
        edit_student.php  # Edit student details
        logout.php        # Logout
        profile.php       # Admin profile
        show_student.php  # View all students
        uploads/          # Admin-specific uploads
    staff/
        dashboard.php     # Staff dashboard
    student/
        dashboard.php     # Student dashboard
uploads/                  # General uploads directory
users/
    login.php             # User login
    logout.php            # User logout
    signup.php            # User registration
```

## Setup Instructions
1. **Prerequisites**:
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Apache/Nginx web server
   - Composer (optional, for dependencies)

2. **Database Setup**:
   - Create a database named `student_management_app`.
   - Import the schema (assuming tables: `users`, `admins`, `students` with appropriate columns).
   - Update `config/database.php` with your MySQL credentials (currently hardcoded; consider using environment variables for security).

3. **Installation**:
   - Clone or place the project in your web server's root directory (e.g., `/var/www/html/`).
   - Ensure the `uploads/` directory is writable (chmod 777).
   - Start your web server and navigate to the project URL.

4. **Usage**:
   - Register as Admin/Staff/Student via `users/signup.php`.
   - Login via `users/login.php`.
   - Admins can manage students from the dashboard.

## Security Notes
- Passwords are hashed using `password_hash()`.
- Prepared statements are used to prevent SQL injection.
- File uploads include basic validation, but consider additional checks for production.
- Sessions are used for authentication; regenerate session IDs to prevent fixation.
- Avoid displaying errors in production; use logging instead.

## Interview-Level Scenario-Based Questions

### Basic Level Questions
1. **Scenario: A new developer joins the team and needs to understand how user login works.**  
   Explain the flow of the login process in `users/login.php`. What happens when a user submits the login form, and how does the system redirect based on user roles? (Hint: Cover session handling, prepared statements, and password verification.)

2. **Scenario: You're debugging why a student record isn't saving during signup.**  
   In `users/signup.php`, describe the validation checks for the signup form. What happens if the email is already registered, and how is the password stored securely?

3. **Scenario: The admin wants to add a new student but encounters a form error.**  
   Walk through the form validation in `profile/admin/add_student.php`. What validations are applied to fields like name, email, mobile, and course, and how are errors displayed to the user?

4. **Scenario: A user reports they can't access the admin dashboard after logging in.**  
   Based on `users/login.php`, explain how sessions are used to manage user authentication and role-based access. What happens if a session variable is missing?

5. **Scenario: The system needs to connect to the database for every page.**  
   Describe the database connection setup in `config/database.php`. What are the potential issues if the connection fails, and how is it handled?

### Intermediate Level Questions
1. **Scenario: A security audit flags the database credentials as a risk.**  
   In `config/database.php`, the credentials are hardcoded. Discuss why this is insecure and suggest improvements (e.g., using environment variables). How would you refactor this without changing the code structure?

2. **Scenario: An attacker tries to inject SQL into the login form.**  
   Analyze the use of prepared statements in `users/login.php`. How do they prevent SQL injection compared to direct string concatenation? Provide an example of a vulnerable query and how the current code mitigates it.

3. **Scenario: The admin uploads a malicious file as a student profile image.**  
   Review the file upload logic in `profile/admin/add_student.php`. What security checks are in place (e.g., file type, size), and what vulnerabilities might still exist (e.g., file inclusion attacks)? How could you enhance it?

4. **Scenario: The system needs to handle multiple admins registering simultaneously.**  
   In `users/signup.php`, when an admin signs up, data is inserted into both `users` and `admins` tables. Discuss potential race conditions or transaction issues. How would you ensure data consistency using MySQL transactions?

5. **Scenario: A student user tries to access the admin add_student page directly.**  
   Explain the access control in `profile/admin/add_student.php` (e.g., session checks). What happens if a non-admin tries to access it? Suggest ways to improve role-based authorization across the app.

6. **Scenario: The login page shows errors in production but not locally.**  
   The code has `ini_set('display_errors', 1);` in `users/login.php`. Discuss why this is problematic in production and how error handling should be managed (e.g., logging vs. displaying).

### Advanced Level Questions
1. **Scenario: The student management system is growing, with thousands of students and concurrent users.**  
   Based on the current database queries (e.g., in `profile/admin/add_student.php`), discuss scalability issues like N+1 queries or lack of indexing. How would you optimize database performance (e.g., adding indexes, using JOINs, or caching)?

2. **Scenario: A hacker exploits session fixation to impersonate an admin.**  
   Analyze session management across files like `users/login.php` and `profile/admin/dashboard.php`. How could session fixation occur, and what mitigations (e.g., regenerating session IDs) should be implemented?

3. **Scenario: The system needs to support API endpoints for mobile app integration.**  
   Propose how to refactor the current PHP files (e.g., `users/login.php`) into RESTful APIs. What changes would you make for JSON responses, stateless authentication (e.g., JWT), and handling CORS?

4. **Scenario: File uploads are causing server overload during peak times.**  
   In `profile/admin/add_student.php`, file uploads are handled synchronously. Discuss potential issues with large files or many uploads. Suggest solutions like asynchronous processing, cloud storage (e.g., AWS S3), or rate limiting.

5. **Scenario: The app needs to log all admin actions for audit purposes.**  
   Currently, actions like adding students aren't logged. Design a logging system that records admin activities (e.g., using a `logs` table or external services like ELK stack). How would you integrate this without disrupting existing code?

6. **Scenario: The system must comply with GDPR for student data privacy.**  
   Review data handling in files like `profile/admin/add_student.php` (e.g., storing personal info). What changes are needed for data minimization, consent, and deletion requests? How would you implement data encryption at rest?

7. **Scenario: The app needs to handle high traffic with load balancing.**  
   Discuss how the current session-based authentication might fail in a distributed environment (e.g., multiple servers). Propose solutions like shared sessions (Redis) or token-based auth.

## Contributing
- Follow PHP coding standards.
- Test changes locally before committing.
- Ensure security best practices are maintained.

## License
This project is for educational purposes. Use at your own risk.