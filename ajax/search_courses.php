<?php
require_once __DIR__ . '/../config/db.php';
$q = trim($_GET['q'] ?? '');
$like = "%$q%";
$stmt = $pdo->prepare("SELECT * FROM courses WHERE title LIKE ? OR category LIKE ? OR instructor LIKE ? ORDER BY title");
$stmt->execute([$like,$like,$like]);
$courses = $stmt->fetchAll();

if (!$courses) { echo '<div class="card"><p>No courses found.</p></div>'; exit; }
foreach ($courses as $c): ?>
<div class="card course-card">
<span class="tag"><?= htmlspecialchars($c['category']) ?></span>
<h3><?= htmlspecialchars($c['title']) ?></h3>
<p><?= htmlspecialchars($c['description']) ?></p>
<p class="muted">👨‍🏫 <?= htmlspecialchars($c['instructor']) ?> · ⏱ <?= htmlspecialchars($c['duration']) ?> · <?= htmlspecialchars($c['level']) ?></p>
<div class="bottom"><a class="btn" href="<?= BASE_URL ?>/enroll.php?id=<?= $c['id'] ?>">Enroll</a></div>
</div>
<?php endforeach; ?>
