<?php
session_start();
if (!isset($_SESSION['last_order'])) {
    header("Location: cart.php");
    exit();
}

$order = $_SESSION['last_order'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Invoice - ERRY</title>
    <style>
        @media print {
            body {
                padding: 20px;
                font-family: Arial, sans-serif;
            }
            .no-print {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .total-section {
            text-align: right;
        }
        .btn-print {
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn-print no-print">Print Invoice</button>
    
    <div class="invoice-header">
        <h1>ERRY</h1>
        <h2>Invoice</h2>
    </div>

    <div class="invoice-details">
        <p><strong>Date:</strong> <?php echo $order['date']; ?></p>
        <p><strong>Order ID:</strong> <?php echo substr(md5(uniqid()), 0, 8); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Artist</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars($item['artist']); ?></td>
                <td>$<?php echo number_format($item['price'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Subtotal:</strong> $<?php echo number_format($order['subtotal'], 2); ?></p>
        <?php if ($order['discount'] > 0): ?>
        <p><strong>Discount (<?php echo ($order['discount'] * 100); ?>%):</strong> -$<?php echo number_format($order['discountAmount'], 2); ?></p>
        <?php endif; ?>
        <p><strong>Final Total:</strong> $<?php echo number_format($order['finalTotal'], 2); ?></p>
    </div>

    <script>
        // Auto-print when page loads and redirect after printing
        window.onload = function() {
            window.print();
            // Listen for the print dialog to close
            window.onafterprint = function() {
                window.location.href = '../index.php';  // Redirect to home page
            };
        }
    </script>
</body>
</html> 