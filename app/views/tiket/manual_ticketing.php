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

// if (isset($_SESSION['user_id'])) {
//     require_once __DIR__ . '/../../models/Tiket_model.php';
//     $tiketModel = new Tiket_model();

//     $rowCountTiket = $tiketModel->checkUserBuy($_SESSION['user_id'], $data['dataDetailFilm']['film_id']);
// } else {
//     $rowCountTiket = 0;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/tiket/manual_ticketing_2.css">
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

        <div id="containerMovie">
            <p>CARA PEMESANAN TIKET</p>
            <ul>
                <li>1. Pastikan anda sudah memiliki akun. Jika belum punya, silakan registrasi dan login.</li>
                <li>2. Pilih film yang ingin ditonton di halaman movies.</li>
                <li>3. Klik detail film untuk melihat info film dan memesan tiket berdasarkan jadwal yang tersedia.</li>
                <li>4. Pilih berapa banyak tiket yang ingin dibeli.</li>
                <li>5. Pilih bangku yang ingin ditempati.</li>
                <li>6. Pilih cara pembayaran dan lakukan pembayaran.</li>
            </ul>
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
    <script src="<?= BASE_URL ?>javascript/film/manual_ticketing.js"></script>
</body>

</html>