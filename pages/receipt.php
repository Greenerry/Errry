<?php
session_start();
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['last_order'])) {
    header("Location: cart.php");
    exit();
}
$base_path = '../';
include '../includes/head.php';

$order = $_SESSION['last_order'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Receipt - ERRY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
            .w3-black {
                background-color: #000 !important;
                color: #fff !important;
            }
        }
        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
        }
        .receipt-header {
            font-size: 2.5em;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }
        .item-row {
            padding: 20px 0;
            border-bottom: 1px solid #333;
        }
        .item-title {
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        .item-artist {
            color: #888;
            font-size: 0.9em;
        }
        .item-price {
            font-size: 1.2em;
            padding-top: 10px;
        }
        .totals-section {
            margin-top: 30px;
            padding: 20px 0;
            font-size: 1.1em;
        }
        .final-total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #333;
            font-size: 1.3em;
        }
        .thank-you {
            margin-top: 40px;
            font-style: italic;
            color: #888;
            font-size: 1.1em;
        }
        .action-buttons {
            margin-top: 40px;
        }
        .action-buttons button, .action-buttons a {
            padding: 12px 24px;
            margin: 0 10px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="w3-top no-print">
        <div class="w3-bar w3-black w3-padding">
            <a href="../index.php" class="w3-bar-item w3-button logo">ERRY</a>
            <div class="w3-right">
                <a href="profile.php" class="w3-bar-item w3-button"><i class="fas fa-user"></i></a>
                <a href="cart.php" class="w3-bar-item w3-button"><i class="fas fa-shopping-cart"></i></a>
                <a href="logout.php" class="w3-bar-item w3-button">Sair</a>
            </div>
        </div>
    </div>

    <!-- Receipt Content -->
    <div class="w3-content w3-padding-64 w3-container">
        <div class="receipt-container">
            <header class="w3-center">
                <h1 class="w3-text-white receipt-header">Recibo da Compra</h1>
            </header>

            <div class="w3-card w3-black">
                <div class="w3-container">
                    <?php 
                    $subtotal = 0;
                    foreach ($order['items'] as $item): 
                        $subtotal += $item['price'];
                    ?>
                        <div class="item-row">
                            <div class="w3-row">
                                <div class="w3-col m8">
                                    <div class="item-title"><?php echo $item['title']; ?></div>
                                    <div class="item-artist"><?php echo $item['artist']; ?></div>
                                </div>
                                <div class="w3-col m4">
                                    <div class="item-price w3-right-align">$<?php echo number_format($item['price'], 2); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php
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

                    <div class="totals-section">
                        <div class="w3-row">
                            <div class="w3-col m8">
                                <p>Subtotal:</p>
                            </div>
                            <div class="w3-col m4">
                                <p class="w3-right-align">$<?php echo number_format($subtotal, 2); ?></p>
                            </div>
                        </div>

                        <?php if ($discount > 0): ?>
                        <div class="w3-row w3-text-red">
                            <div class="w3-col m8">
                                <p>Desconto (<?php echo ($discount * 100); ?>%):</p>
                            </div>
                            <div class="w3-col m4">
                                <p class="w3-right-align">-$<?php echo number_format($discountAmount, 2); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="w3-row final-total">
                            <div class="w3-col m8">
                                <p><strong>Total Final:</strong></p>
                            </div>
                            <div class="w3-col m4">
                                <p class="w3-right-align"><strong>$<?php echo number_format($finalTotal, 2); ?></strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="w3-center thank-you">
                        <p>Obrigado por comprar na ERRY!</p>
                    </div>
                </div>
            </div>

            <div class="w3-center action-buttons no-print">
                <button onclick="window.print()" class="w3-button w3-white">Imprimir Recibo</button>
                <a href="../index.php" class="w3-button w3-transparent w3-border w3-border-white">Voltar para Loja</a>
            </div>
        </div>
    </div>

    <div class="no-print">
        <?php include '../includes/footer.php'; ?>
    </div>

</body>
</html> 