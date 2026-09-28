<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/csrf.php';
$page_title = 'Login | LearnSphere';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id,name,email,password_hash,role,verified FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        $error = 'Invalid email or password.';
    } elseif (!$user['verified']) {
        $error = 'Please verify your email before logging in.';
    } else {
        $_SESSION['user'] = $user;
        header('Location: ' . BASE_URL . '/dashboard.php');
        exit;
    }
}
require_once __DIR__ . '/includes/header.php';
?>
<div class="card form">
<h2>Login</h2>
<?php if($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post">
<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
<label>Email</label><input type="email" name="email" required>
<label>Password</label><input type="password" name="password" required>
<br><br><button class="btn">Login</button>
</form>
<p class="muted">New user? <a href="register.php">Create an account</a></p>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
