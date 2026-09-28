<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/csrf.php';
require_login();

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT id,title FROM courses WHERE id=?");
$stmt->execute([$id]);
$course = $stmt->fetch();
if (!$course) exit('Course not found.');

$stmt = $pdo->prepare("INSERT IGNORE INTO enrollments(user_id,course_id) VALUES(?,?)");
$stmt->execute([$_SESSION['user']['id'],$id]);

header('Location: dashboard.php?enrolled=1');
exit;
?>
