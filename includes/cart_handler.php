<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    $album = [
        'id' => $data['id'],
        'title' => $data['title'],
        'artist' => $data['artist'],
        'price' => $data['price'],
        'cover' => $data['cover']
    ];
    
    $_SESSION['cart'][] = $album;
    echo json_encode(['success' => true]);
}

// Handle remove action
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] === $_GET['id']) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    echo json_encode(['success' => true]);
    exit;
}
?> 