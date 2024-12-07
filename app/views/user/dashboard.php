<?php
session_start();

// menentukan navbar
if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    require_once __DIR__ . '/../../models/User_model.php';
    $userModel = new User_model();

    $userId = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $user = $userModel->getUserById($userId);
    if ($user && $key === hash('sha256', $user['username'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
    }
}

if (isset($_SESSION['user_id'])) {
    require_once __DIR__ . '/../../models/Tiket_model.php';
    $tiketModel = new Tiket_model();

    $result = $tiketModel->tiketUserBeli($_SESSION['user_id']);
    $rowCountTiketUser = $result['row_count'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/user/dashboard_user.css">
    <link rel="icon" href="<?= BASE_URL ?>img/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="container">
        <header>
            <div id="title">
                <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>img/home/logo.png" alt="logoAthena"></a>
                <h1>BIOSKOP ATHENA</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="<?= BASE_URL ?>film/">Movies</a></li>
                    <li><a href="<?= BASE_URL ?>tiket/ticketing/">Ticketing</a></li>
                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true): ?>
                        <li><a href="<?= BASE_URL ?>user/logoutAkun/">Logout</a></li>
                        <li><a href="<?= BASE_URL ?>user/dashboard/">Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>user/login/">Login</a></li>
                        <li><a href="<?= BASE_URL ?>user/register/">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <div class="ticketContainer">
            <?php if ($rowCountTiketUser > 0): ?>
                <?php foreach ($result['data'] as $tiket): ?>
                    <div class="tketItem">
                        <h1 class="judul"><?= htmlspecialchars($tiket['judul_film']) ?></h1>
                        <p class="order_id"><?= htmlspecialchars($tiket['order_id']) ?></p>
                        <p class="jumlah"><?= htmlspecialchars($tiket['jumlah_tiket']) ?> Tiket</p>
                        <p class="status">Transaksi Sukses</p>
                        <button type="button">Beri Ulasan</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="tketItemGagal">
                    <h1 class="judul">Anda tdak memiliki tiket</h1>
                </div>
            <?php endif; ?>
        </div>

        <footer>
            <div class="optionalPage">
                <a href="">News</a>
                <a href="">Contact</a>
                <a href="">About Us</a>
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>
</body>

</html>