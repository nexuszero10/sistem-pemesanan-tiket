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

    $rowCountTiket = $tiketModel->checkUserBuy($_SESSION['user_id'], $data['dataDetailFilm']['film_id']);
} else {
    $rowCountTiket = 0;
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
            <div id="posterFilm">
                <img src="<?= BASE_URL . '/img/film/' . ($data['dataDetailFilm']['image']) ?>" alt="<?= str_replace(' ', '', strtolower($data['dataDetailFilm']['judul'])) . ".png"; ?>">
                <div id="reviewFilm" style="display: none;">
                    <form action="" method="post" name="reviewFilm" id="reviewForm">
                        <input type="hidden" id="inputHiddenUserTiket" name="userTiket" value="<?= $rowCountTiket ?>">
                        <input type="hidden" id="inputHiddenFilmId" name="filmId" value="<?= $data['dataDetailFilm']['film_id'] ?>" required>
                        <input type="hidden" id="inputHiddenUserId" name="userId" value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>" required>
                        <div id="namaRate">
                            <?php if (isset($_SESSION['username'])): ?>
                                <input type="text" id="inputUser" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" required>
                            <?php else: ?>
                                <input type="text" id="inputUser" name="username" placeholder="username" required>
                            <?php endif; ?>
                            <input type="number" placeholder="Rating" id="rating" name="rating" min="0" max="10" required>
                        </div>
                        <textarea name="komentar" id="komentar" placeholder="Comment on the movie" required rows="3"></textarea>
                        <input type="hidden" id="inputHiddenDate" name="datePostReview" value="<?= date('Y-m-d') ?>">
                        <button type="button" id="post_review_button">PUBLISH</button>
                    </form>
                </div>
            </div>

            <div id="infoFilm">
                <h1 id="yellow"><?= $data['dataDetailFilm']['judul'] ?></h1>
                <table cellpadding="4.5px">
                    <tr>
                        <td>Direktor</td>
                        <td>:</td>
                        <td><?= $data['dataDetailFilm']['director'] ?></td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td>:</td>
                        <td><?= $data['dataDetailFilm']['duration'] ?> minutes</td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>:</td>
                        <td><?= $data['dataDetailFilm']['genre'] ?></td>
                    </tr>
                    <tr>
                        <td>Realese</td>
                        <td>:</td>
                        <td><?= $data['dataDetailFilm']['tahun_rilis'] ?></td>
                    </tr>
                    <tr>
                        <td>Cast</td>
                        <td>:</td>
                        <td><?= $data['dataDetailFilm']['cast'] ?></td>
                    </tr>
                </table>
                <h1>Synopsis</h1>
                <p><?= $data['dataDetailFilm']['synopsis'] ?></p>
                <div id="listButton">
                    <div id="listButton">
                        <button id="watch-trailer-button" data-trailer-url="<?= $data['dataDetailFilm']['url_trailer']; ?>">WATCH TRAILER</button>
                        <button id="form-review-button">POST REVIEW</button>
                        <button id="get-ticket-button"
                            data-film='<?= htmlspecialchars(json_encode($data['dataDetailFilm']), ENT_QUOTES, 'UTF-8') ?>'
                            data-jadwal='<?= htmlspecialchars(json_encode($data['dataJadwalFilm']), ENT_QUOTES, 'UTF-8') ?>'
                            data-user-id="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
                            GET TICKET
                        </button>
                    </div>
                </div>
                <?php if (isset($data['dataUlasanFilm']) && !empty($data['dataUlasanFilm'])): ?>
                    <div id="listReview" data-review='<?= json_encode($data['dataUlasanFilm']) ?>'></div>
                <?php else: ?>
                    <div id="listReview"></div>
                <?php endif ?>
            </div>
        </div>

        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>

    <div id="trailerPopup" class="popup">
        <div class="popup-trailer">
            <iframe id="trailer" width="800" height="450" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <div id="selectTicketPopup" class="popup">
        <form action="<?= BASE_URL ?>tiket/ticketing/" method="post" class="popup-ticket">
            <h1>Select Ticket</h1>
            <h2>Number of Ticket</h2>
            <input type="hidden" name="inputHiddenUser" value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>" required>
            <input type="hidden" name="inputHiddenFilmId" value="" required>
            <input type="hidden" name="inputHiddenJadwalId" value="" required>
            <select name="numberOfTicket" id="selectTicket" required>
                <option value="placeholder" selected disabled>Pilih jumlah tiket</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <div class="selectButton">
                <button type="submit" name="submitTicketNumber" id="btn-ticket-number">CONTINUE</button>
                <button type="button" name="cancelTicketNumber" id="btn-ticket-cancel">CANCEL</button>
            </div>
        </form>
    </div>
    <script src="<?= BASE_URL ?>javascript/film/detail_5.js"></script>
</body>

</html>