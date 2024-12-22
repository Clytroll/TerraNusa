<?php
// payment.php
require_once 'config.php';
session_start();

if (!isset($_SESSION['order_id'])) {
    header('Location: index.php');
    exit;
}

$order_id = $_SESSION['order_id'];

// Ambil data order
$stmt = $pdo->prepare("SELECT o.*, p.name as package_name FROM orders o JOIN packages p ON o.package_id = p.id WHERE o.id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerraNusa - Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Same tailwind config as before -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#245B4F',
                        'secondary': '#6A9C89',
                        'tertiary': '#C4DAD2',
                        'background': '#E9EFEC',
                    }
                }
            }
        }
    </script>
    <style>
        .container-custom {
            width: 85%;
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }
    </style>
</head>
<body class="bg-background">
    <main class="pt-32">
        <div class="container-custom">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h1 class="text-2xl font-bold text-primary mb-6">Pembayaran</h1>
                    
                    <!-- Order Summary -->
                    <div class="bg-background rounded-lg p-4 mb-6">
                        <h2 class="font-semibold text-lg mb-4">Detail Pesanan</h2>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Nomor Pesanan:</span>
                                <span class="font-semibold"><?php echo $order['order_number']; ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Paket:</span>
                                <span class="font-semibold"><?php echo $order['package_name']; ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tanggal Tour:</span>
                                <span class="font-semibold"><?php echo date('d F Y', strtotime($order['tour_date'])); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Jumlah Peserta:</span>
                                <span class="font-semibold"><?php echo $order['participant_count']; ?> orang</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-primary">
                                <span>Total Pembayaran:</span>
                                <span>Rp <?php echo number_format($order['total_amount'], 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <form action="process_payment.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Metode Pembayaran</label>
                                <select name="payment_method" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>
                                    <option value="">Pilih metode pembayaran</option>
                                    <option value="transfer_bca">Transfer Bank BCA</option>
                                    <option value="transfer_mandiri">Transfer Bank Mandiri</option>
                                    <option value="transfer_bni">Transfer Bank BNI</option>
                                </select>
                            </div>

                            <div class="payment-instructions bg-tertiary/20 p-4 rounded-lg">
                                <h3 class="font-semibold mb-2">Instruksi Pembayaran:</h3>
                                <ol class="list-decimal list-inside space-y-2">
                                    <li>Transfer ke rekening yang sesuai dengan pilihan bank Anda</li>
                                    <li>Jumlah yang harus ditransfer: <span class="font-semibold">Rp <?php echo number_format($order['total_amount'], 0, ',', '.'); ?></span></li>
                                    <li>Simpan bukti transfer</li>
                                    <li>Upload bukti transfer pada form di bawah</li>
                                </ol>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Upload Bukti Transfer</label>
                                <input type="file" name="proof_of_payment" accept="image/*" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>
                            </div>

                            <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-lg transition-colors duration-300">
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>