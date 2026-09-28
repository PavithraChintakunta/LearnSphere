<?php
require_once __DIR__ . '/config/db.php';
$page_title = 'Courses | LearnSphere';
$stmt = $pdo->query("SELECT * FROM courses ORDER BY created_at DESC");
$courses = $stmt->fetchAll();
require_once __DIR__ . '/includes/header.php';
?>
<h1>Explore Courses</h1>
<p class="muted">Use AJAX search to find a course instantly.</p>
<div class="searchbar"><input id="courseSearch" placeholder="Search by course, category or instructor..."></div>
<div id="courseResults" class="grid">
<?php foreach($courses as $c): ?>
<div class="card course-card">
<span class="tag"><?= htmlspecialchars($c['category']) ?></span>
<h3><?= htmlspecialchars($c['title']) ?></h3>
<p><?= htmlspecialchars($c['description']) ?></p>
<p class="muted">👨‍🏫 <?= htmlspecialchars($c['instructor']) ?> · ⏱ <?= htmlspecialchars($c['duration']) ?> · <?= htmlspecialchars($c['level']) ?></p>
<div class="bottom">
<?php if(is_logged_in()): ?><a class="btn" href="enroll.php?id=<?= $c['id'] ?>">Enroll</a>
<?php else: ?><a class="btn" href="login.php">Login to Enroll</a><?php endif; ?>
</div>
</div>
<?php endforeach; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
