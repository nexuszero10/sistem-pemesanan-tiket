<?php
require_once __DIR__ . "/midtrans-php-master/Midtrans.php";
// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-Bgr4gKzDpzljxz3YsJfhxHMX';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Membaca input JSON
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validasi data
if (!isset($data['total_harga'], $data['film_id'], $data['jumlah_tiket'], $data['judul_film'], $data['username'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data received']);
    exit;
}

// Parameter untuk Snap Midtrans
$params = array(
    'transaction_details' => array(
        'order_id' => uniqid('order-'),
        'gross_amount' => $data['total_harga'],
    ),
    'item_details' => array(
        array(
            'id' => $data['film_id'],
            'name' => $data['judul_film'],
            'price' => $data['total_harga'] / $data['jumlah_tiket'],
            'quantity' => $data['jumlah_tiket'],
        )
    ),
    'customer_details' => array(
        'first_name' => $data['username'],
        'email' => $data['email'],
        'phone' => $data['phone'],
    ),
);

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    header('Content-Type: application/json');
    echo json_encode(['snap_token' => $snapToken]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
