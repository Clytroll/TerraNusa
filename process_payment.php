<?php
// process_payment.php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];
    
    // Handle file upload
    $target_dir = "uploads/proof/";
    $file_extension = pathinfo($_FILES["proof_of_payment"]["name"], PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $file_name;
    
    if (move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target_file)) {
        try {
            // Insert payment record
            $stmt = $pdo->prepare("INSERT INTO payments (order_id, payment_method, proof_of_payment) VALUES (?, ?, ?)");
            $stmt->execute([$order_id, $payment_method, $file_name]);
            
            // Update order status
            $stmt = $pdo->prepare("UPDATE orders SET status = 'pending' WHERE id = ?");
            $stmt->execute([$order_id]);
            
            $_SESSION['success'] = "Pembayaran berhasil dikonfirmasi! Tim kami akan memverifikasi pembayaran Anda.";
            header('Location: payment_success.php');
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload file.";
    }
}
?>