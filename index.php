<?php
require_once __DIR__ . '/config/db.php';
$page_title = 'LearnSphere | E-Learning Portal';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div>
    <span class="tag">CAPSTONE PROJECT • TASK 5</span>
    <h1>Learn. Practice. Build your career.</h1>
    <p>LearnSphere is a professional e-learning portal with secure authentication, course enrollment, AJAX search and an analytics dashboard.</p>
    <a class="btn" href="<?= BASE_URL ?>/courses.php">Explore Courses</a>
    <a class="btn btn-secondary" href="<?= BASE_URL ?>/register.php">Create Account</a>
  </div>
  <div class="hero-card">🎓</div>
</section>
<div class="grid">
  <div class="card"><h3>🔐 Secure Login</h3><p class="muted">Email OTP verification and password hashing.</p></div>
  <div class="card"><h3>⚡ AJAX Search</h3><p class="muted">Search and filter courses without refreshing the page.</p></div>
  <div class="card"><h3>📊 Analytics</h3><p class="muted">Admin dashboard with enrollment statistics and Chart.js.</p></div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
