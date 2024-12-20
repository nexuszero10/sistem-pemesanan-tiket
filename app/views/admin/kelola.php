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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
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
            width: auto;
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
            margin-bottom: 40px;
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
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav li:hover a {
            color: #1b2027;
        }

        #movieList {
            display: flex;
            flex-direction: column;
            padding: 5px;
            width: 87.5%;
            margin: 0 auto;
            border-radius: 25px;
            gap: 5px;
        }

        .sub-List {
            display: flex;
            flex-direction: row;
            padding: 5px;
            gap: 15px;
            box-sizing: border-box;
        }

        .movieContent {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #222831;
            padding: 15px;
            border-radius: 15px;
            box-sizing: border-box;
            max-width: calc(25% - 10px);
            gap: 5px;
            justify-content: space-between;
            border: 2px solid #393E46;
        }

        .movieContent * {
            margin: 0;
        }

        .movieContent h2 {
            font-size: 20.5px;
            text-align: center;
            padding-bottom: 10px;
        }

        .movieContent img {
            width: 100%;
            height: 350px;
            border-radius: 15px;
            margin-bottom: 10px;
        }

        .movieButton {
            display: flex;
            flex-direction: row;
            padding: 5px;
            box-sizing: border-box;
            justify-content: center;
            gap: 15px;
            margin-top: auto;
        }

        .movieButton button {
            background-color: #FFDB00;
            font-size: 15px;
            border-radius: 30px;
            padding: 5px 7.5px;
            border: none;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            letter-spacing: 1px;
            transition: transform 0.3s ease-in-out;
        }

        .movieButton button:hover {
            cursor: pointer;
            transform: scale(1.1);
        }

        footer {
            background-color: #1a1d23;
            color: #f0f0f0;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            border-top: 1.5px solid #333;
            margin-top: 45px;
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

        <div id="movieList">
            <?php
            $films = $data['semuaFilm'];
            $chunkedFilms = array_chunk($films, 4);
            foreach ($chunkedFilms as $filmGroup): ?>
                <div class="sub-List">
                    <?php foreach ($filmGroup as $film): ?>
                        <div class="movieContent">
                            <img src="<?= BASE_URL ?>img/film/<?= $film['image'] ?>" alt="<?= $film['judul']; ?>">
                            <h2><?= $film['judul']; ?></h2>
                            <div class="movieButton">
                                <a href="<?= BASE_URL ?>film/detailFilm/<?= $film['film_id']; ?>"><button>Kelola Film</button></a>
                                <a href="<?= BASE_URL ?>jadwal/detailJadwal/<?= $film['film_id']; ?>"><button>Kelola Jadwal</button></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <footer>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>

    <?php if (isset($data['success-hapus-film'])): ?>
        <script>
            Swal.fire({
                title: 'Hapus  Data Film Berhasil!',
                text: '<?= htmlspecialchars($data['success-hapus-film']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
            });
        </script>
        <?php unset($data['success-hapus-film']) ?>
    <?php endif; ?>

    <?php if (isset($data['success-hapus-jadwal'])): ?>
        <script>
            Swal.fire({
                title: 'Hapus Data Jadwal Berhasil!',
                text: '<?= htmlspecialchars($data['success-hapus-jadwal']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
            });
        </script>
        <?php unset($data['success-hapus-jadwal']) ?>
    <?php endif; ?>
</body>

</html>