<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/csrf.php';
require_admin();
$page_title='Manage Courses | LearnSphere';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    verify_csrf();
    $action=$_POST['action']??'';
    if($action==='add'){
        $stmt=$pdo->prepare("INSERT INTO courses(title,category,description,instructor,duration,level) VALUES(?,?,?,?,?,?)");
        $stmt->execute([trim($_POST['title']),trim($_POST['category']),trim($_POST['description']),trim($_POST['instructor']),trim($_POST['duration']),$_POST['level']]);
    } elseif($action==='delete'){
        $stmt=$pdo->prepare("DELETE FROM courses WHERE id=?"); $stmt->execute([(int)$_POST['id']]);
    }
    header('Location: courses.php'); exit;
}
$courses=$pdo->query("SELECT * FROM courses ORDER BY id DESC")->fetchAll();
require_once __DIR__ . '/../includes/header.php';
?>
<h1>Manage Courses</h1>
<div class="admin-nav"><a class="btn" href="index.php">Analytics</a><a class="btn btn-secondary" href="users.php">Users</a></div>
<div class="grid-2">
<div class="card">
<h2>Add Course</h2>
<form method="post" class="form" style="margin:0;max-width:none">
<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>"><input type="hidden" name="action" value="add">
<label>Title</label><input name="title" required>
<label>Category</label><input name="category" required>
<label>Description</label><textarea name="description" required></textarea>
<label>Instructor</label><input name="instructor" required>
<label>Duration</label><input name="duration" value="4 weeks">
<label>Level</label><select name="level"><option>Beginner</option><option>Intermediate</option><option>Advanced</option></select>
<br><br><button class="btn">Add Course</button>
</form>
</div>
<div class="card"><h2>Course List</h2>
<?php foreach($courses as $c): ?><div style="padding:12px 0;border-bottom:1px solid #eee"><b><?= htmlspecialchars($c['title']) ?></b><br><span class="muted"><?= htmlspecialchars($c['category']) ?></span>
<form method="post" style="margin-top:8px"><input type="hidden" name="csrf_token" value="<?= csrf_token() ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-danger btn-small" onclick="return confirm('Delete course?')">Delete</button></form>
</div><?php endforeach; ?>
</div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
