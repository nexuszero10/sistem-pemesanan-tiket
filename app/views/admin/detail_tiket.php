<?php

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: " . BASE_URL . "admin/");
    exit;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            background-color: #1b2027;
            color: #ffffff;
        }

        #container {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;

        }

        .page {
            font-size: 30px;
            font-style: italic;
            color: #ffd700;
            text-align: center;
        }

        header {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #1a1e25;
            margin-bottom: 45px;
            padding-top: 10px;
            border-bottom: 1.5px solid #333;
        }

        #title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 100px;
        }

        #title h1 {
            margin-left: 20px;
            font-size: 32.5px;
            color: #ffd700;
            letter-spacing: 7.5px;
            word-spacing: 10px;
        }

        #title img {
            max-width: 130px;
            height: auto;
        }

        nav ul {
            display: flex;
            list-style-type: none;
            margin-left: 10px;
            gap: 10px;
            padding: 0;
            align-items: center;
            justify-content: flex-start;
        }

        nav ul li {
            cursor: pointer;
        }

        nav li {
            font-size: 18px;
            background-color: #393E46;
            color: #ffd700;
            padding: 10px 15px;
            border-radius: 30px;
        }


        a {
            color: #ffd700;
            text-decoration: none;
        }

        nav li:hover {
            background-color: #ffd700;
            color: #1b2027;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav li:hover a {
            color: #1b2027;
        }

        .ticketContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
            max-width: 1000px;
            padding: 25px 15px;
            border-radius: 10px;
            background-color: #222831;
            margin: 0 auto;
        }

        .tketItem {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            background-color: #393e46;
            width: 100%;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            gap: 20px;
        }

        .tketItem h1 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            color: #ffd700;
        }

        .tketItem p {
            font-size: 16px;
            margin: 0;
            color: #ffffff;
        }

        .tketItem .tanggal {
            color: #ffd700;
            font-weight: 500;
        }

        .tketItemGagal {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            background-color: #393e46;
            width: 100%;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            gap: 20px;
        }

        .tketItemGagal h1 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            color: #ffd700;      
        }

        footer {
            background-color: #1a1d23;
            color: #f0f0f0;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            border-top: 1.5px solid #333;
            margin-top: 45px;
            margin-top: auto;
        }

        footer .optionalPage {
            margin-bottom: 10px;
        }

        footer .optionalPage a {
            color: #f0f0f0;
            margin: 0 15px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            font-size: 15px;
        }

        footer .optionalPage a:hover {
            color: #ffd700;
        }

        footer .copyright {
            margin-top: 10px;
            font-size: 17.5px;
            color: #ccc;
        }

        ::-webkit-scrollbar {
            width: 6.5px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #424956;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: #1b2027;
            padding: 2px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div id="container">

        <header>
            <div id="title">
                <a href="<?= BASE_URL ?>admin/kelola"><img src="<?= BASE_URL ?>img/home/logo.png" alt="logoAthena"></a>
                <h1>BIOSKOP ATHENA</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="<?= BASE_URL ?>admin/kelola/">Kelola Film</a></li>
                    <li><a href="<?= BASE_URL ?>jadwal/listJadwal/">Data Jadwal</a></li>
                    <li><a href="<?= BASE_URL ?>tiket/listTiket/">Data Tiket</a></li>
                    <li><a href="<?= BASE_URL ?>admin/logout/">Logout</a></li>
                </ul>
            </nav>
        </header>
        <div class="ticketContainer">
            <?php if ($data['dataDetailTiket']): ?>
                <?php foreach ($data['dataDetailTiket'] as $tiket): ?>
                    <div class="tketItem">
                        <h1 class="judul"><?= htmlspecialchars($tiket['username']) ?></h1>
                        <p class="order_id"><?= htmlspecialchars($tiket['order_id']) ?></p>
                        <p class="jumlah"><?= htmlspecialchars($tiket['jumlah_tiket']) ?> Tiket</p>
                        <p class="kursi"><?= htmlspecialchars($tiket['kursi_dipilih']) ?></p>
                        <p class="tanggal"><?= htmlspecialchars($tiket['tanggal']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="tketItemGagal">
                    <h1 class="judul">Film belum pernah ditonton</h1>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="optionalPage">
        </div>
        <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
    </footer>
</body>

</html>