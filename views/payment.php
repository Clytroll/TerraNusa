<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../includes/db.php';

// Cek apakah ada order_id
if (!isset($_SESSION['order_id'])) {
    die("No order ID found in session");
}

// Get order details
$order_id = $_SESSION['order_id'];
$stmt = $conn->prepare("SELECT o.* FROM orders o WHERE o.id = ?");

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    die("Order not found in database");
}

// Get package info separately
$pkg_stmt = $conn->prepare("SELECT name FROM packagess WHERE id = ?");
if ($pkg_stmt) {
    $pkg_stmt->bind_param("i", $order['package_id']);
    $pkg_stmt->execute();
    $pkg_result = $pkg_stmt->get_result();
    $package = $pkg_result->fetch_assoc();
    $order['packagess'] = $package ? $package['name'] : 'Unknown Package';
}

require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<!-- Sisanya sama seperti sebelumnya -->

<main class="pt-32">
    <div class="container-custom">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Order Summary -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-primary mb-6">Detail Pemesanan</h1>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kode Pesanan:</span>
                            <span class="font-medium"><?php echo $order['order_code']; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Paket:</span>
                            <span class="font-medium"><?php echo $order['packagess']; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Tour:</span>
                            <span class="font-medium"><?php echo date('d F Y', strtotime($order['tour_date'])); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Peserta:</span>
                            <span class="font-medium"><?php echo $order['participant_count']; ?> orang</span>
                        </div>
                        <div class="flex justify-between border-t pt-4">
                            <span class="font-semibold">Total Pembayaran:</span>
                            <span class="font-bold text-primary">Rp <?php echo number_format($order['total_amount'], 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Payment Instructions -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h2 class="text-lg font-semibold text-blue-900 mb-4">Instruksi Pembayaran</h2>
                    <p class="text-blue-800 font-medium mb-4">Transfer ke rekening berikut:</p>
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <p class="mb-2">Bank BCA</p>
                        <p class="text-2xl font-bold mb-1">1234567890</p>
                        <p>a.n. PT TerraNusa Travel</p>
                    </div>
                    <div class="text-blue-800 text-sm space-y-2">
                        <p>• Mohon transfer sesuai dengan nominal yang tertera</p>
                        <p>• Setelah transfer, Admin kami akan memverifikasi pembayaran Anda</p>
                        <p>• Status pesanan akan diupdate dalam 1x24 jam kerja</p>
                    </div>
                </div>

                <div class="text-center">
                    <a href="../index.php" class="text-primary hover:text-primary/80">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>