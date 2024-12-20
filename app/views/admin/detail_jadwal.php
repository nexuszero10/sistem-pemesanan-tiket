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

        .containerMovie {
            display: flex;
            flex-direction: row;
            width: 62.5%;
            padding: 5px;
            gap: 5px;
            margin: auto;
            border-radius: 30px;
            padding: 20px;
            background-color: #2D333D;
            margin-bottom: 20px;
        }

        .posterFilm img {
            width: 85%;
            max-height: auto;
            border-radius: 20px;
        }

        .posterFilm {
            display: flex;
            flex: 1.25;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
            padding: 25px 0px;
            padding-top: 5px;
        }

        .infoFilm {
            display: flex;
            flex-direction: column;
            flex: 2.25;
            padding: 10px 0px;
            margin-top: 25px;
        }

        .infoFilm * {
            margin: 0;
        }

        .infoFilm h1 {
            font-size: 27.5px;
            color: #ffd700;
            letter-spacing: 1.5px;
        }

        .infoFilm table {
            width: 70%;
            font-size: 20px;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .listButton {
            display: flex;
            flex-direction: row;
            align-self: center;
            gap: 30px;
            margin-top: 30px;
        }

        .listButton button {
            border-radius: 30px;
            padding: 7.5px 10px;
            letter-spacing: 1.5px;
            font-size: 15px;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            font-weight: 500;
            background-color: #2D333D;
            color: #f0f0f0;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: 1px solid #ffd700;
        }

        .listButton button:hover {
            background-color: #ffd700;
            border: none;
            color: #2D333D;
            transform: scale(1.1);
            cursor: pointer;
        }

        .listButton button:focus {
            background-color: #ffd700;
            border: none;
            color: #2D333D;
            transform: scale(1.1);
            cursor: pointer;
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

        <?php foreach ($data['dataDetailJadwal'] as $jadwal): ?>
            <div class="containerMovie">
                <div class="posterFilm">
                    <img src="<?= BASE_URL . '/img/film/' . ($data['dataDetailFilm']['image']) ?>" alt="<?= str_replace(' ', '', strtolower($data['dataDetailFilm']['judul'])) . ".png"; ?>">
                </div>

                <div class="infoFilm">
                    <h1 class="yellow"><?= htmlspecialchars($data['dataDetailFilm']['judul']) ?></h1>
                    <div class="jadwalItem">
                        <table cellpadding="4.5px">
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><?= htmlspecialchars($jadwal['tanggal']) ?></td>
                            </tr>
                            <tr>
                                <td>Hari</td>
                                <td>:</td>
                                <td><?= htmlspecialchars($jadwal['hari']) ?></td>
                            </tr>
                            <tr>
                                <td>Pukul</td>
                                <td>:</td>
                                <td><?= htmlspecialchars($jadwal['pukul']) ?></td>
                            </tr>
                            <tr>
                                <td>Studio</td>
                                <td>:</td>
                                <td>Studio <?= htmlspecialchars($jadwal['studio_id']) ?></td>
                            </tr>
                            <tr>
                                <td>Kapasitas tersedia</td>
                                <td>:</td>
                                <td><?= htmlspecialchars($jadwal['kapasitas_studio']) ?></td>
                            </tr>
                        </table>
                        <div class="listButton">
                            <a href="<?= BASE_URL ?>jadwal/tambahJadwal/<?= $jadwal['film_id'] ?>"><button id="tambahJadwal">Tambah Jadwal</button></a>
                            <a href="<?= BASE_URL ?>jadwal/updateJadwal/<?= $jadwal['jadwal_id'] ?>"><button class="editJadwal">Edit Jadwal</button></a>
                            <a href="<?= BASE_URL ?>jadwal/hapusDataJadwal/<?= $jadwal['jadwal_id'] ?>"><button class="hapusJadwal">Hapus Jadwal</button></a>
                            <a href="<?= BASE_URL ?>jadwal/resetJadwal/<?= $jadwal['jadwal_id'] ?>"><button class="resetJadwal">Reset Jadwal</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>

    <script>
        document.querySelectorAll('.hapusJadwal').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data jadwal akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= BASE_URL ?>jadwal/hapusDataJadwal/<?= $jadwal['jadwal_id'] ?>';
                    }
                });
            });
        });

        document.querySelectorAll('.resetJadwal').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data jadwal akan direset!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Reset!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= BASE_URL ?>jadwal/resetDataJadwal/<?= $jadwal['jadwal_id'] ?>';
                    }
                });
            });
        });
    </script>
</body>

</html>