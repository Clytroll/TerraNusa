<?php
session_start();
echo realpath('../includes/db.php'); // Tampilkan path absolut
var_dump(file_exists('../includes/db.php')); // Periksa apakah file ada




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate order code
    $order_code = 'TN' . date('ymd') . rand(1000, 9999);

    // Get form data
    $package_id = $_POST['package_id'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $tour_date = $_POST['tourDate'];
    $participant_count = $_POST['participantCount'];
    $total_amount = $_POST['total_amount'];

    try {
        // Insert order to database
        $stmt = $conn->prepare("INSERT INTO orders (order_code, package_id, customer_name, customer_phone, tour_date, participant_count, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sisssid", 
            $order_code,
            $package_id,
            $customer_name,
            $customer_phone,
            $tour_date,
            $participant_count,
            $total_amount
        );

        if ($stmt->execute()) {
            $_SESSION['order_id'] = $stmt->insert_id;
            $_SESSION['order_code'] = $order_code;
            header("Location: ../views/payment.php");
            exit;
        } else {
            throw new Exception("Gagal menyimpan pesanan");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>