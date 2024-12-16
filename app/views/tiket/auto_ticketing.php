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
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-VyaPRnSGa3ysxYM4">
    </script>
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
            <div class="seatStatus">
                <div class="buttonItem">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#FFD43B"
                                d="<?= path ?>" />
                        </svg>
                    </button>
                    <p>Kursi Tersedia</p>
                </div>

                <div class="buttonItem">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#25EF61"
                                d="<?= path ?>" />
                        </svg>
                    </button>
                    <p>Kursi Anda</p>
                </div>

                <div class="buttonItem">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#E3E3E3"
                                d="<?= path ?>" />
                        </svg>
                    </button>
                    <p>Kursi Tidak Tersedia</p>
                </div>
            </div>

            <div class="booking">
                <form class="bookingInfo" action="">
                    <input type="hidden" id="userId" value="<?= $data['dataUserTiket']['user_id']; ?>">
                    <input type="hidden" id="userUsername" value="<?= $data['dataUserTiket']['username'] ?>">
                    <input type="hidden" id="jadwalId" value="<?= $data['dataJadwalTiketId']['jadwal_id']; ?>">
                    <input type="hidden" id="filmId" value="<?= $data['dataFilmTiketId']['film_id']; ?>">
                    <input type="hidden" id="filmJudul" value="<?= $data['dataFilmTiketId']['judul']; ?>">
                    <div id="seatData" style="display: none;" data-occupied-seats='<?= json_encode(explode(", ", $data['listbangkuTerisi'])); ?>'></div>
                    <h1 class="infoJudul"><span id="bookJudul"><?= $data['dataFilmTiketId']['judul']; ?></span></h1>
                    <p class="infoNumberOfTicket">Tickets: <span id="numberOfSelectedSeats">0</span>/<span id="bookTickets"><?= $data['dataJumlahTiketBeli']; ?></span></p>
                    <p class="infoStudio">Studio : <span id="bookStudio"><?= $data['dataJadwalTiketId']['studio_id']; ?></span></p>
                    <p class="infoSeats">Seats : <span id="bookSeats"></span></p>
                    <div class="divDateTime">
                        <p class="infoDate">Date : <span id="bookDate"><?= $data['dataJadwalTiketId']['tanggal']; ?></span></p>
                        <p class="infoTime">Time : <span id="bookTime"><?= $data['dataJadwalTiketId']['pukul']; ?></span></p>
                    </div>
                    <p class="infoPayment" id="infoHarga" data-harga-film='<?= $data['dataFilmTiketId']['harga'] * $data['dataJumlahTiketBeli']; ?>'>
                        Total Payment :
                        <span id="bookPayment">
                            Rp<?= number_format($data['dataFilmTiketId']['harga'] * $data['dataJumlahTiketBeli'], 0, ',', '.'); ?>
                        </span>
                    </p>
                    <div class="listButton">
                        <button type="submit" name="confirmBook" id="confirmBook">Confirm Order</button>
                        <button type="button" name="cancelBook" id="cancelBook">Cancel</button>
                    </div>
                </form>

                <div class="bookingSeat">
                    <div class="listSeat">
                        <?php $rowSeats = ['A', 'B', 'C', 'D']; ?>
                        <div class="seatLeft">
                            <?php foreach ($rowSeats as $row): ?>
                                <div class="<?= $row ?> seat">
                                    <?php for ($number = 1; $number <= 4; $number++) : ?>
                                        <button type="button" name="<?= $row ?><?= $number ?>" class="seatButton" id="<?= $row ?><?= $number ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path fill="#FFD43B"
                                                    d="<?= path ?>" />
                                            </svg>
                                        </button>
                                    <?php endfor; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="seatSplitter">
                            <?php foreach ($rowSeats as $row): ?>
                                <div class="rowSplitter">
                                    <p id="<?= $row ?>"><?= $row ?></p>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <div class="seatRight">
                            <?php foreach ($rowSeats as $row): ?>
                                <div class="<?= $row ?> seat">
                                    <?php for ($number = 5; $number <= 8; $number++) : ?>
                                        <button type="button" name="<?= $row ?><?= $number ?>" class="seatButton" id="<?= $row ?><?= $number ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path fill="#FFD43B"
                                                    d="<?= path ?>" />
                                            </svg>
                                        </button>
                                    <?php endfor; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="screen">
                        <p>SCREEN POSITION</p>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>
    <script src="<?= BASE_URL ?>javascript/tiket/auto_ticketing_2.js"></script>
</body>

</html>