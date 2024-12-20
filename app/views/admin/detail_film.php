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
            color: #1b2027;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav li:hover a {
            color: #1b2027;
        }

        #containerMovie {
            display: flex;
            flex-direction: row;
            width: 67.5%;
            padding: 5px;
            gap: 5px;
            margin: auto;
            border-radius: 30px;
            padding: 20px;
            background-color: #2D333D;
        }

        #posterFilm img {
            width: 92.5%;
            max-height: auto;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        #posterFilm {
            display: flex;
            flex: 1.25;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
            padding: 25px 0px;
            padding-top: 5px;
        }

        #infoFilm {
            display: flex;
            flex-direction: column;
            flex: 2.25;
            padding: 10px 0px;
        }

        #infoFilm * {
            margin: 0;
        }

        #infoFilm h1 {
            font-size: 20px;
            margin: 10px;
            margin-left: 0;
            margin: 0;
            color: #ffd700;
            letter-spacing: 1.5px;
        }

        #infoFilm p {
            font-size: 15px;
            line-height: 1.75;
            text-align: justify;
            margin-top: 5px;
            letter-spacing: 0.5px;

        }

        #infoFilm table {
            width: 100%;
            font-size: 15px;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        #infoFilm #listButton {
            margin-top: 30px;
            padding: 0px 10px;
        }

        #listButton button {
            border-radius: 30px;
            padding: 10px 15px;
            letter-spacing: 1.5px;
            font-size: 13.5px;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            font-weight: 500;
            background-color: #2D333D;
            color: #f0f0f0;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            border: 1px solid #ffd700;
        }

        #listButton button:hover {
            background-color: #ffd700;
            border: none;
            color: #2D333D;
            transform: scale(1.1);
        }

        #listButton button:focus {
            background-color: #ffd700;
            border: none;
            color: #2D333D;
            transform: scale(1.1);
        }

        #listButton {
            display: flex;
            flex-direction: row;
            align-self: center;
            gap: 50px;
            margin-top: 10px;
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

        <div id="containerMovie">
            <div id="posterFilm">
                <img src="<?= BASE_URL . '/img/film/' . ($data['dataDetailFilm']['image']) ?>" alt="<?= str_replace(' ', '', strtolower($data['dataDetailFilm']['judul'])) . ".png"; ?>">
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
                    <a href="<?= BASE_URL ?>film/updateFilm/<?= $data['dataDetailFilm']['film_id'] ?>"><button id="editFilm">Edit Film</button></a>
                    <a href="<?= BASE_URL ?>film/hapusFilm/<?= $data['dataDetailFilm']['film_id'] ?>"><button id="hapusFilm">Hapus Film</button></a>
                    <a href="<?= BASE_URL ?>film/tambahFilm/"><button id="tambahFilm">Tambah Film</button></a>
                </div>
            </div>
        </div>

        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>

    <script>
        document.getElementById('hapusFilm').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data film akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= BASE_URL ?>film/hapusFilm/<?= $data['dataDetailFilm']['film_id'] ?>';
                }
            });
        });
    </script>
</body>

</html>