<?php
require_once __DIR__ . '/db.php';

function is_logged_in(): bool {
    return isset($_SESSION['user']);
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . '/login.php');
        exit;
    }
}

function require_admin(): void {
    require_login();
    if (($_SESSION['user']['role'] ?? '') !== 'admin') {
        http_response_code(403);
        exit('Access denied.');
    }
}

function refresh_session_user(PDO $pdo): void {
    if (!is_logged_in()) return;
    $stmt = $pdo->prepare("SELECT id, name, email, role, verified FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user']['id']]);
    $user = $stmt->fetch();
    if ($user) $_SESSION['user'] = $user;
}
?>
