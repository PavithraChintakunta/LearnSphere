<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/csrf.php';
require_admin();
$page_title='Manage Users | LearnSphere';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    verify_csrf();
    $action=$_POST['action']??'';
    $id=(int)($_POST['id']??0);
    if($action==='role'){
        $role=$_POST['role']==='admin'?'admin':'student';
        $stmt=$pdo->prepare("UPDATE users SET role=? WHERE id=?"); $stmt->execute([$role,$id]);
    } elseif($action==='delete' && $id !== $_SESSION['user']['id']){
        $stmt=$pdo->prepare("DELETE FROM users WHERE id=?"); $stmt->execute([$id]);
    }
    header('Location: users.php'); exit;
}
$users=$pdo->query("SELECT id,name,email,role,verified,created_at FROM users ORDER BY id DESC")->fetchAll();
require_once __DIR__ . '/../includes/header.php';
?>
<h1>Users</h1>
<div class="admin-nav"><a class="btn" href="index.php">Analytics</a><a class="btn btn-secondary" href="courses.php">Courses</a></div>
<table><tr><th>Name</th><th>Email</th><th>Role</th><th>Verified</th><th>Action</th></tr>
<?php foreach($users as $u): ?><tr>
<td><?= htmlspecialchars($u['name']) ?></td><td><?= htmlspecialchars($u['email']) ?></td><td><?= htmlspecialchars($u['role']) ?></td>
<td><?= $u['verified']?'Yes':'No' ?></td>
<td>
<form method="post" style="display:inline"><input type="hidden" name="csrf_token" value="<?= csrf_token() ?>"><input type="hidden" name="action" value="role"><input type="hidden" name="id" value="<?= $u['id'] ?>"><input type="hidden" name="role" value="<?= $u['role']==='admin'?'student':'admin' ?>"><button class="btn btn-small"><?= $u['role']==='admin'?'Make Student':'Make Admin' ?></button></form>
<?php if($u['id']!=$_SESSION['user']['id']): ?><form method="post" style="display:inline"><input type="hidden" name="csrf_token" value="<?= csrf_token() ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $u['id'] ?>"><button class="btn btn-danger btn-small" onclick="return confirm('Delete this user?')">Delete</button></form><?php endif; ?>
</td></tr><?php endforeach; ?></table>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
