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
    <link rel="stylesheet" href="<?= BASE_URL ?>css/<?= $data['file'] ?>.css">
    <link rel="icon" href="<?= BASE_URL ?>img/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
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

        <div id="movieList">
            <?php foreach ($data['semuaFilm'] as $barisKey => $barisFilm): ?>
                <div class="sub-List">
                    <?php foreach ($barisFilm as $filmKey => $film): ?>
                        <div class="movieContent">
                            <img src="<?= BASE_URL ?>img/film/<?= $film['image'] ?>" alt="<?= $film['image'] ?>">
                            <h2><?= $film['judul']; ?></h2>
                            <div class="movieButton">
                                <button onclick="openTrailer('<?= $film['url_trailer']; ?>')">Trailer</button>
                                <a href="<?= BASE_URL ?>film/detail/<?= $film['film_id']; ?>"><button>Detail</button></a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
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

    <div id="trailerPopup" class="popup">
        <div class="popup-content">
            <iframe id="trailer" width="800" height="450" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <script src="<?= BASE_URL ?>javascript/film/index.js"></script>
</body>

</html>