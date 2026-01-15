<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
$base_path = '../';
include '../includes/head.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - ERRY</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="../index.php" class="logo">ERRY</a>
            <div class="nav-right">
                <a href="profile.php" class="nav-icon"><i class="fas fa-user"></i></a>
                <a href="cart.php" class="nav-icon"><i class="fas fa-shopping-cart"></i></a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
    </nav>
    <main class="container">
        <h1>Seu Perfil</h1>
        <div class="profile-container">
            <div class="profile-info">
                <div class="info-group">
                    <label>Nome de Usuário</label>
                    <p><?php echo $_SESSION['username']; ?></p>
                </div>
                <div class="info-group">
                    <label>Email</label>
                    <p><?php echo $_SESSION['email']; ?></p>
                </div>
                <div class="info-group">
                    <label>Membro Desde</label>
                    <p><?php echo date('F j, Y', strtotime($_SESSION['created_at'])); ?></p>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo $base_path; ?>assets/js/bounce.js"></script>

<?php include '../includes/footer.php'; ?>

</body>
</html> 