<?php
session_start();
$base_path = '../';
include '../includes/head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $username = trim($_POST['username']);

    // Get existing users or create empty array
    $users = isset($_SESSION['users']) ? $_SESSION['users'] : [];

    // Check if email already exists
    if (isset($users[$email])) {
        $error = "Email already registered";
    } else {
        // Add new user
        $users[$email] = [
            'password' => $password,
            'username' => $username,
            'created_at' => date('Y-m-d')
        ];

        // Save users array back to session
        $_SESSION['users'] = $users;

        // Redirect to login
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - ERRY</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
</head>
<body>
    <div class="auth-form">
        <h2>Registrar</h2>
        <?php if (isset($error)): ?>
            <div class="error-message" style="margin-bottom: 1rem; color: #ff4444; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" id="registerForm" novalidate>
            <div class="form-group">
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <span class="error-message"></span>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
                <span class="error-message"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Senha" required>
                <span class="error-message"></span>
            </div>
            <button type="submit" class="btn">Registrar</button>
        </form>
        <p>Já tem uma conta? <a href="login.php">Entrar</a></p>
    </div>
    <script src="../assets/js/validation.js"></script>

    <script src="<?php echo $base_path; ?>assets/js/bounce.js"></script>

    <?php include '../includes/footer.php'; ?>
</body>
</html> 