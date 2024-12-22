<?php
// process_order.php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_id = $_POST['package_id'];
    $phone = $_POST['customerPhone'];
    $tour_date = $_POST['tourDate'];
    $participant_count = $_POST['participantCount'];
    $total_amount = $_POST['totalAmount'];
    
    try {
        // Insert ke tabel orders
        $order_number = generateOrderNumber();
        $stmt = $pdo->prepare("INSERT INTO orders (order_number, package_id, customer_phone, tour_date, participant_count, total_amount) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$order_number, $package_id, $phone, $tour_date, $participant_count, $total_amount]);
        
        $order_id = $pdo->lastInsertId();
        $_SESSION['order_id'] = $order_id;
        
        header('Location: payment.php');
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}