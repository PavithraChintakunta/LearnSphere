<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/csrf.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($page_title ?? APP_NAME) ?></title>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header class="topbar">
  <a class="brand" href="<?= BASE_URL ?>/index.php">Learn<span>Sphere</span></a>
  <nav>
    <a href="<?= BASE_URL ?>/index.php">Home</a>
    <a href="<?= BASE_URL ?>/courses.php">Courses</a>
    <?php if (is_logged_in()): ?>
      <a href="<?= BASE_URL ?>/dashboard.php">Dashboard</a>
      <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
        <a href="<?= BASE_URL ?>/admin/index.php">Admin</a>
      <?php endif; ?>
      <a class="btn btn-small" href="<?= BASE_URL ?>/logout.php">Logout</a>
    <?php else: ?>
      <a href="<?= BASE_URL ?>/login.php">Login</a>
      <a class="btn btn-small" href="<?= BASE_URL ?>/register.php">Register</a>
    <?php endif; ?>
  </nav>
</header>
<main class="container">
