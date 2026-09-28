<?php
require_once __DIR__ . '/config/auth.php';
require_login();
$page_title = 'Dashboard | LearnSphere';

$stmt = $pdo->prepare("SELECT c.*, e.status, e.enrolled_at FROM enrollments e JOIN courses c ON c.id=e.course_id WHERE e.user_id=? ORDER BY e.enrolled_at DESC");
$stmt->execute([$_SESSION['user']['id']]);
$enrollments = $stmt->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>
<h1>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> 👋</h1>
<?php if(isset($_GET['enrolled'])): ?><div class="alert success">Course enrollment successful.</div><?php endif; ?>
<div class="stats">
<div class="stat"><span class="muted">Enrolled Courses</span><b><?= count($enrollments) ?></b></div>
<div class="stat"><span class="muted">Completed</span><b><?= count(array_filter($enrollments, fn($e)=>$e['status']==='completed')) ?></b></div>
<div class="stat"><span class="muted">Role</span><b><?= htmlspecialchars(ucfirst($_SESSION['user']['role'])) ?></b></div>
<div class="stat"><span class="muted">Email</span><b style="font-size:15px"><?= htmlspecialchars($_SESSION['user']['email']) ?></b></div>
</div>
<h2>My Learning</h2>
<div class="grid">
<?php foreach($enrollments as $e): ?>
<div class="card">
<span class="tag"><?= htmlspecialchars($e['status']) ?></span>
<h3><?= htmlspecialchars($e['title']) ?></h3>
<p class="muted"><?= htmlspecialchars($e['category']) ?> · <?= htmlspecialchars($e['duration']) ?></p>
</div>
<?php endforeach; ?>
<?php if(!$enrollments): ?><div class="card"><p>You have not enrolled in any course yet.</p><a class="btn" href="courses.php">Browse Courses</a></div><?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
