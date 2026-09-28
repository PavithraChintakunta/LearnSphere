<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/csrf.php';
$page_title = 'Verify Email | LearnSphere';
$error = '';
$success = '';

$email = $_SESSION['pending_email'] ?? '';
if (!$email) { header('Location: register.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $otp = trim($_POST['otp'] ?? '');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !$user['otp_expires_at'] || strtotime($user['otp_expires_at']) < time()) {
        $error = 'OTP expired. Please register again.';
    } elseif (!password_verify($otp, $user['otp_hash'])) {
        $error = 'Invalid OTP.';
    } else {
        $stmt = $pdo->prepare("UPDATE users SET verified=1,otp_hash=NULL,otp_expires_at=NULL WHERE id=?");
        $stmt->execute([$user['id']]);
        unset($_SESSION['pending_email'], $_SESSION['dev_otp']);
        $success = 'Email verified successfully. You can now login.';
    }
}
require_once __DIR__ . '/includes/header.php';
?>
<div class="card form">
<h2>Email Verification</h2>
<p class="muted">OTP sent to <b><?= htmlspecialchars($email) ?></b>.</p>
<?php if($success): ?><div class="alert success"><?= $success ?> <a href="login.php">Login</a></div><?php endif; ?>
<?php if($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<?php if(!$success): ?>
<?php if(!empty($_SESSION['dev_otp'])): ?><div class="alert success">Development OTP: <b><?= htmlspecialchars($_SESSION['dev_otp']) ?></b></div><?php endif; ?>
<form method="post">
<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
<label>6-digit OTP</label><input name="otp" maxlength="6" required>
<br><br><button class="btn">Verify</button>
</form>
<?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
