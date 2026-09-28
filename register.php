<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/csrf.php';
$page_title = 'Register | LearnSphere';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $error = 'Enter a valid name, email and password (minimum 6 characters).';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'An account with this email already exists.';
        } else {
            $otp = (string)random_int(100000, 999999);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $otpHash = password_hash($otp, PASSWORD_DEFAULT);
            $expires = date('Y-m-d H:i:s', time() + OTP_EXPIRY_MINUTES * 60);

            $stmt = $pdo->prepare("INSERT INTO users(name,email,password_hash,otp_hash,otp_expires_at) VALUES(?,?,?,?,?)");
            $stmt->execute([$name,$email,$hash,$otpHash,$expires]);

            $_SESSION['pending_email'] = $email;

            $subject = APP_NAME . ' - Email Verification OTP';
            $message = "Your verification OTP is $otp. It expires in " . OTP_EXPIRY_MINUTES . " minutes.";
            @mail($email, $subject, $message, "From: " . MAIL_FROM);

            // Development helper: remove before production if your mail server works.
            $_SESSION['dev_otp'] = $otp;
            header('Location: ' . BASE_URL . '/verify.php');
            exit;
        }
    }
}
require_once __DIR__ . '/includes/header.php';
?>
<div class="card form">
<h2>Create your account</h2>
<?php if($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post">
<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
<label>Full Name</label><input name="name" required>
<label>Email</label><input type="email" name="email" required>
<label>Password</label><input type="password" name="password" minlength="6" required>
<br><br><button class="btn" type="submit">Register</button>
</form>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
