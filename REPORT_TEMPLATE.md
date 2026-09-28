# LearnSphere Project Report

## 1. Title
LearnSphere — E-Learning Portal

## 2. Abstract
LearnSphere is a web-based e-learning portal designed to provide students with an easy way to discover courses, create verified accounts, enroll in courses and monitor learning activity. Administrators can manage users and courses and view enrollment analytics.

## 3. Problem Statement
Students often need a centralized platform where learning resources, course discovery, registration and progress-related information are available in one place.

## 4. Objectives
- Build a responsive e-learning portal.
- Implement secure registration and login.
- Add email OTP verification.
- Create course and enrollment modules.
- Implement AJAX search and filtering.
- Provide an admin analytics dashboard.
- Deploy the application online.

## 5. Modules
- Authentication
- Course Management
- Enrollment
- Student Dashboard
- AJAX Search
- Admin Management
- Analytics

## 6. Database
Include the ER diagram from `database/ER_DIAGRAM.md` and screenshots of the tables.

## 7. Security
- Passwords are stored using password_hash().
- SQL injection is reduced using PDO prepared statements.
- CSRF tokens protect state-changing forms.
- Role checks restrict the admin panel.
- Sessions are used for authentication.

## 8. Testing
Test registration, invalid login, OTP expiry, course search, enrollment, admin access, course deletion and responsive design.

## 9. Deployment
Mention the hosting provider, hosted URL, GitHub repository and database configuration.

## 10. Screenshots
Add:
1. Home page
2. Register
3. OTP verification
4. Login
5. Course page
6. AJAX search
7. Student dashboard
8. Admin dashboard
9. User management
10. Course management

## 11. Conclusion
LearnSphere demonstrates a complete PHP/MySQL web application workflow from design and database creation to authentication, dynamic features, analytics and deployment.
