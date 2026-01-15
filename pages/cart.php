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
    <title>Cart - ERRY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-black w3-padding">
            <a href="../index.php" class="w3-bar-item w3-button logo">ERRY</a>
            <div class="w3-right">
                <a href="profile.php" class="w3-bar-item w3-button"><i class="fas fa-user"></i></a>
                <a href="cart.php" class="w3-bar-item w3-button"><i class="fas fa-shopping-cart"></i></a>
                <a href="logout.php" class="w3-bar-item w3-button">Sair</a>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="w3-content w3-padding-64 w3-container" style="max-width:1200px">
        <header class="w3-center w3-padding-32">
            <h1 class="w3-text-white">Seu Carrinho</h1>
        </header>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="w3-panel w3-red w3-padding">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']); 
                ?>
            </div>
        <?php endif; ?>

        <div class="w3-container w3-content" style="max-width:800px">
            <?php if (empty($_SESSION['cart'])): ?>
                <div class="w3-panel w3-black w3-center w3-padding-64">
                    <p class="w3-large">Seu carrinho está vazio</p>
                </div>
            <?php else: ?>
                <?php 
                $subtotal = array_sum(array_column($_SESSION['cart'], 'price'));
                $discount = 0;
                if ($subtotal >= 1000) {
                    $discount = 0.15;
                } elseif ($subtotal >= 500) {
                    $discount = 0.10;
                } elseif ($subtotal >= 200) {
                    $discount = 0.05;
                }
                $discountAmount = $subtotal * $discount;
                $finalTotal = $subtotal - $discountAmount;
                ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="w3-card w3-black w3-margin-bottom">
                        <div class="w3-row w3-padding">
                            <div class="w3-col s12 m4 w3-center">
                                <img src="<?php echo $base_path . $item['cover']; ?>" alt="<?php echo $item['title']; ?>" class="w3-image" style="max-width:200px">
                            </div>
                            <div class="w3-col s12 m5 w3-padding w3-center">
                                <h3><?php echo $item['title']; ?></h3>
                                <p class="artist"><?php echo $item['artist']; ?></p>
                                <p class="price">$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="w3-col s12 m3 w3-padding w3-center">
                                <button class="w3-button w3-transparent w3-border w3-border-white remove-item" data-id="<?php echo $item['id']; ?>">Remover</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="w3-card w3-black w3-padding w3-margin-top">
                    <div class="w3-row w3-padding">
                        <div class="w3-col s12 w3-center">
                            <div class="w3-row w3-padding" style="max-width:300px;margin:auto">
                                <div class="w3-col s6 w3-left-align">Subtotal:</div>
                                <div class="w3-col s6 w3-right-align">$<?php echo number_format($subtotal, 2); ?></div>
                            </div>
                            <?php if ($discount > 0): ?>
                                <div class="w3-row w3-padding w3-text-red" style="max-width:300px;margin:auto">
                                    <div class="w3-col s6 w3-left-align">Desconto (<?php echo ($discount * 100); ?>%):</div>
                                    <div class="w3-col s6 w3-right-align">-$<?php echo number_format($discountAmount, 2); ?></div>
                                </div>
                            <?php endif; ?>
                            <div class="w3-row w3-padding w3-large" style="max-width:300px;margin:auto">
                                <div class="w3-col s6 w3-left-align">Total Final:</div>
                                <div class="w3-col s6 w3-right-align">$<?php echo number_format($finalTotal, 2); ?></div>
                            </div>
                            <form action="../includes/order_handler.php" method="POST" id="checkoutForm" style="max-width:300px;margin:auto">
                                <button type="submit" class="w3-button w3-white w3-block w3-margin-top">Finalizar Compra</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?php echo $base_path; ?>assets/js/cart.js"></script>
    <script src="<?php echo $base_path; ?>assets/js/bounce.js"></script>

<?php include '../includes/footer.php'; ?>

</body>
</html> 