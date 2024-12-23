<?php
session_start();
require_once '../../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    if (in_array($status, ['paid', 'cancelled'])) {
        $stmt = $conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $order_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Status pesanan berhasil diperbarui";
        } else {
            $_SESSION['error'] = "Gagal memperbarui status pesanan";
        }
    }
}

header("Location: index.php");
exit;
?>