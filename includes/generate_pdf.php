<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once(__DIR__ . '/tcpdf/tcpdf.php');  // Updated path

if (isset($_SESSION['last_order'])) {
    try {
        $order = $_SESSION['last_order'];
        
        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Set document information
        $pdf->SetCreator('ERRY');
        $pdf->SetAuthor('ERRY Shop');
        $pdf->SetTitle('Order Invoice');
        
        // Add a page
        $pdf->AddPage();
        
        // Set font
        $pdf->SetFont('helvetica', '', 12);
        
        // Add content
        $pdf->Cell(0, 10, 'ERRY - Order Invoice', 0, 1, 'C');
        $pdf->Ln(10);
        
        $pdf->Cell(0, 10, 'Order Date: ' . $order['date'], 0, 1);
        $pdf->Cell(0, 10, 'Customer: ' . $order['user']['username'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $order['user']['email'], 0, 1);
        $pdf->Ln(10);
        
        // Items table
        foreach ($order['items'] as $item) {
            $pdf->Cell(100, 10, $item['title'], 0);
            $pdf->Cell(30, 10, '$' . number_format($item['price'], 2), 0, 1);
        }
        
        $pdf->Ln(10);
        $pdf->Cell(100, 10, 'Subtotal:', 0);
        $pdf->Cell(30, 10, '$' . number_format($order['subtotal'], 2), 0, 1);
        
        if ($order['discount'] > 0) {
            $pdf->Cell(100, 10, 'Discount:', 0);
            $pdf->Cell(30, 10, ($order['discount'] * 100) . '% (-$' . number_format($order['discountAmount'], 2) . ')', 0, 1);
        }
        
        $pdf->Cell(100, 10, 'Final Total:', 0);
        $pdf->Cell(30, 10, '$' . number_format($order['final_total'], 2), 0, 1);
        
        // Output PDF
        $pdf->Output('ERRY_invoice.pdf', 'D');
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No order found in session";
    exit;
}
?> 