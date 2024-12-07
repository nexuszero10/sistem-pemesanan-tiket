<?php
session_start();

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="icon" href="<?= BASE_URL ?>img/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/home/index_2.css">
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
                    <a href="<?= BASE_URL ?>film/">
                        <li>Movies</li>
                    </a>
                    <a href="<?= BASE_URL ?>tiket/ticketing/">
                        <li>Ticketing</li>
                    </a>
                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true): ?>
                        <a href="<?= BASE_URL ?>user/logoutAkun/">
                            <li>Logout</li>
                        </a>
                        <a href="<?= BASE_URL ?>user/dashboard/">
                            <li>Dashboard</li>
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>user/login/">
                            <li>Login</li>
                        </a>
                        <a href="<?= BASE_URL ?>user/register/">
                            <li>Register</li>
                        </a>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <div id="sliderContainer">
            <button class="arrow prev" onclick="prevSlide()">&#10094;</button>
            <div id="slider">
                <div class="slide">
                    <img src="<?= BASE_URL ?>img/home/haikyuuu.png" alt="posterHaikyuuu">
                    <br>
                    <h2>Haikyu!! The Dumpster Battle</h2>
                </div>
                <div class="slide">
                    <img src="<?= BASE_URL ?>img/home/despicableme4.jpg" alt="posterDespicableMe4">
                    <br>
                    <h2>Despicable Me 4</h2>
                </div>
                <div class="slide">
                    <img src="<?= BASE_URL ?>img/home/kingdomapes.jpg" alt="posterApes">
                    <br>
                    <h2>Kingdom of the Planet of the Apes</h2>
                </div>
                <div class="slide">
                    <img src="<?= BASE_URL ?>img/home/wonderland.jpg" alt="posterWonderland">
                    <br>
                    <h2>Wonderland</h2>
                </div>
            </div>
            <button class="arrow next" onclick="nextSlide()">&#10095;</button>
        </div>
    </div>
    <script src="<?= BASE_URL ?>javascript/home/home.js"></script>
</body>

</html>