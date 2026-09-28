# LearnSphere — Capstone Project & Deployment

## Project idea
A professional E-Learning Portal built for Task 5. It demonstrates authentication, email OTP verification, course enrollment, AJAX search, an admin panel and Chart.js analytics.

## Technology stack
- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP 8+
- Database: MySQL
- AJAX: Fetch API
- Charts: Chart.js CDN
- Security: PDO prepared statements, password_hash(), CSRF tokens, session authentication
- Deployment target: 000webhost / InfinityFree-style PHP hosting

## Main modules
1. Home page
2. Registration + email OTP verification
3. Login/logout
4. Course listing
5. AJAX course search
6. Student dashboard
7. Course enrollment
8. Admin analytics dashboard
9. Admin user management
10. Admin course management

## Local setup with XAMPP
1. Copy the `Capstone_E_Learning_Portal` folder into `C:\xampp\htdocs\`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin.
4. Import `database/schema.sql`.
5. Open `config/config.php` and confirm DB settings.
6. If the folder is named `Capstone_E_Learning_Portal`, set:
   `BASE_URL = '/Capstone_E_Learning_Portal'`
7. Visit:
   `http://localhost/Capstone_E_Learning_Portal/`
8. Register an account and verify it.
9. Make yourself admin with:
   `UPDATE users SET role='admin', verified=1 WHERE email='your@email.com';`
10. Login again and open Admin.

## OTP note
The project sends OTP using PHP `mail()`. For local development, the OTP is also shown on the verification page. For production, configure the hosting mail service and remove the development OTP display.

## Deployment checklist
- Upload all project files.
- Create a MySQL database and import `schema.sql`.
- Update DB credentials in `config/config.php`.
- Update `BASE_URL`.
- Configure email sending for OTP.
- Test registration, login, search, enrollment and admin access.
- Push the same project to GitHub.

## Suggested Git commands
```bash
git init
git add .
git commit -m "Initial LearnSphere capstone project"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/learnsphere.git
git push -u origin main
```

## Demo flow for the 12-minute video
1. Introduce the problem and project objective — 1 min
2. Home page and course discovery — 1 min
3. Register + OTP verification — 2 min
4. Login and student dashboard — 2 min
5. AJAX search and enrollment — 2 min
6. Admin dashboard and Chart.js analytics — 2 min
7. Security, database and deployment explanation — 1 min
8. Conclusion — 1 min
