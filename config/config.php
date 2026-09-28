<?php
// Basic application configuration
define('APP_NAME', 'LearnSphere');
define('BASE_URL', '/learnsphere'); // Change this for your hosting path.
define('DB_HOST', 'localhost');
define('DB_NAME', 'learnsphere');
define('DB_USER', 'root');
define('DB_PASS', '');

define('MAIL_FROM', 'noreply@example.com');
define('OTP_EXPIRY_MINUTES', 10);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
