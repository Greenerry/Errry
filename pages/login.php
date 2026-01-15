<?php
session_start();
$base_path = '../';
include '../includes/head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Get registered users
    $users = isset($_SESSION['users']) ? $_SESSION['users'] : [];

    if (isset($users[$email]) && $users[$email]['password'] === $password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $users[$email]['username'];
        $_SESSION['email'] = $email;
        $_SESSION['created_at'] = $users[$email]['created_at'];
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - ERRY</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
</head>
<body>
    <div class="auth-form">
        <h2>Entrar</h2>
        <?php if (isset($error)): ?>
            <div class="error-message" style="margin-bottom: 1rem; color: #ff4444; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" id="loginForm" novalidate>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
                <span class="error-message"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Senha" required>
                <span class="error-message"></span>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="register.php">Registrar</a></p>
    </div>
    <script src="../assets/js/validation.js"></script>

    <?php include '../includes/bouncing_dog.php'; ?>
    <script src="<?php echo $base_path; ?>assets/js/bounce.js"></script>

    <?php include '../includes/footer.php'; ?>
</body>
</html> 