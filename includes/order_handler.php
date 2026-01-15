<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['cart'])) {
    try {
        // Store order details in session before clearing cart
        $_SESSION['last_order'] = [
            'items' => $_SESSION['cart'],
            'date' => date('Y-m-d H:i:s')
        ];
        
        // Clear the cart
        $_SESSION['cart'] = [];
        
        // Redirect to receipt page
        header('Location: ../pages/receipt.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../pages/cart.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request or empty cart';
    header('Location: ../pages/cart.php');
    exit;
}
?> 