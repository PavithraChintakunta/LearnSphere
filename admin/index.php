<?php
require_once __DIR__ . '/../config/auth.php';
require_admin();
$page_title = 'Admin Dashboard | LearnSphere';

$users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$courses = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$enrollments = $pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();
$verified = $pdo->query("SELECT COUNT(*) FROM users WHERE verified=1")->fetchColumn();

$rows = $pdo->query("SELECT c.title, COUNT(e.id) total FROM courses c LEFT JOIN enrollments e ON e.course_id=c.id GROUP BY c.id ORDER BY total DESC")->fetchAll();
$labels = array_column($rows,'title');
$values = array_map('intval', array_column($rows,'total'));
require_once __DIR__ . '/../includes/header.php';
?>
<h1>Admin Analytics Dashboard</h1>
<div class="admin-nav">
<a class="btn" href="index.php">Analytics</a><a class="btn btn-secondary" href="users.php">Users</a><a class="btn btn-secondary" href="courses.php">Courses</a>
</div>
<div class="stats">
<div class="stat"><span class="muted">Users</span><b><?= $users ?></b></div>
<div class="stat"><span class="muted">Courses</span><b><?= $courses ?></b></div>
<div class="stat"><span class="muted">Enrollments</span><b><?= $enrollments ?></b></div>
<div class="stat"><span class="muted">Verified Users</span><b><?= $verified ?></b></div>
</div>
<div class="card" style="margin-top:25px"><h2>Enrollments by Course</h2><canvas id="enrollmentChart" height="100"></canvas></div>
<script>
new Chart(document.getElementById('enrollmentChart'), {
 type:'bar',
 data:{labels:<?= json_encode($labels) ?>,datasets:[{label:'Enrollments',data:<?= json_encode($values) ?>}]},
 options:{responsive:true,scales:{y:{beginAtZero:true}}}
});
</script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
