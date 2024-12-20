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
            width: 62.5%;
            padding: 5px;
            gap: 5px;
            margin: auto;
            border-radius: 30px;
            padding: 20px;
            background-color: #2D333D;
        }

        #posterFilm img {
            width: 85%;
            max-height: auto;
            border-radius: 20px;
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
            margin-top: 25px;
        }

        #infoFilm * {
            margin: 0;
        }

        #infoFilm h1 {
            font-size: 27.5px;
            color: #ffd700;
            letter-spacing: 1.5px;
        }

        #infoFilm table {
            width: 70%;
            font-size: 20px;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        #infoFilm #listButton {
            margin-top: 30px;
            padding: 0px 10px;
        }

        #listButton button {
            border-radius: 30px;
            padding: 7.5px 10px;
            letter-spacing: 1.5px;
            font-size: 15px;
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
            cursor: pointer;
        }

        #listButton button:focus {
            background-color: #ffd700;
            border: none;
            color: #2D333D;
            transform: scale(1.1);
            cursor: pointer;
        }

        #listButton {
            display: flex;
            flex-direction: row;
            align-self: center;
            gap: 30px;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 400px;
        }

        input[type="number"] {
            width: 80px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            outline: none;
            font-size: 16px;
            background-color: #2D333D;
            color: #f0f0f0;
            padding: 5px 5px;
            border-radius: 10px;
            border: none;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border: 1px solid #ccc;
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
                <img src="<?= BASE_URL . '/img/film/' . ($data['dataDetailFilmJadwal']['image']) ?>" alt="<?= str_replace(' ', '', strtolower($data['dataDetailFilmJadwal']['judul'])) . ".png"; ?>">
            </div>

            <form id="infoFilm" method="post" action="<?= BASE_URL ?>jadwal/tambahDataJadwal/">
                <h1 id="yellow"><?= $data['dataDetailFilmJadwal']['judul'] ?></h1>
                <table cellpadding="4.5px">
                    <input type="hidden" name="inputFilmId" value="<?= isset($data['film_id']) ? $data['film_id'] : $data['dataDetailFilmJadwal']['film_id'] ?>" required>
                    <tr>
                        <td><label for="inputHari">Hari</label></td>
                        <td>:</td>
                        <td>
                            <input type="text" name="inputHari" id="inputHari" placeholder="pilih tanggal untuk generate hari otomatis" readonly value="<?= isset($data['hari']) ? $data['hari'] : '' ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="inputTanggal">Tanggal</label></td>
                        <td>:</td>
                        <td>
                            <input type="date" name="inputTanggal" id="inputTanggal" onchange="updateDay()" value="<?= isset($data['tanggal']) ? $data['tanggal'] : '' ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="inputPukul">Pukul</label></td>
                        <td>:</td>
                        <td>
                            <select name="inputPukul" id="inputPukul" required>
                                <option value="" disabled <?= !isset($data['pukul']) ? 'selected' : '' ?>>Pilih jam tayang</option>
                                <option value="10:00:00" <?= isset($data['pukul']) && $data['pukul'] == '10:00:00' ? 'selected' : '' ?>>10:00:00</option>
                                <option value="13:00:00" <?= isset($data['pukul']) && $data['pukul'] == '13:00:00' ? 'selected' : '' ?>>13:00:00</option>
                                <option value="16:00:00" <?= isset($data['pukul']) && $data['pukul'] == '16:00:00' ? 'selected' : '' ?>>16:00:00</option>
                                <option value="19:00:00" <?= isset($data['pukul']) && $data['pukul'] == '19:00:00' ? 'selected' : '' ?>>19:00:00</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="inputStudio">Studio</label></td>
                        <td>:</td>
                        <td>
                            <select name="inputStudio" id="inputStudio" required>
                                <option value="" disabled <?= !isset($data['studio_id']) ? 'selected' : '' ?>>Pilih Studio</option>
                                <option value="1" <?= isset($data['studio_id']) && $data['studio_id'] == 1 ? 'selected' : '' ?>>Studio 1</option>
                                <option value="2" <?= isset($data['studio_id']) && $data['studio_id'] == 2 ? 'selected' : '' ?>>Studio 2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="inputKapasitas">Kapasitas</label></td>
                        <td>:</td>
                        <td><input type="number" name="inputKapasitas" id="inputKapasitas" value="<?= isset($data['kapasitas_studio']) ? $data['kapasitas_studio'] : '24' ?>" required readonly></td>
                    </tr>
                </table>
                <div id="listButton">
                    <a href="<?= BASE_URL ?>/jadwal/tambahDataJadwal/"><button id="tambahJadwal">Tambah Jadwal</button></a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="optionalPage">
        </div>
        <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
    </footer>
    </div>

    <script>
        function updateDay() {
            const selectedDate = document.getElementById("inputTanggal").value;
            const dateObj = new Date(selectedDate);
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayOfWeek = dateObj.getDay();
            const dayInput = document.getElementById("inputHari");
            dayInput.value = days[dayOfWeek] || "";
        }

        window.onload = function() {
            updateDay();
        };
    </script>

    <?php if (isset($data['error-tambah'])): ?>
        <script>
            Swal.fire({
                title: 'Tambah Data Jadwal Gagal!',
                text: '<?= htmlspecialchars($data['error-tambah']) ?>',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        </script>
        <?php unset($data['error-tambah']); ?>
    <?php endif; ?>

    <?php if (isset($data['success-tambah'])): ?>
        <script>
            Swal.fire({
                title: 'Tambah Data Jadwal Berhasil!',
                text: '<?= htmlspecialchars($data['success-tambah']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>/jadwal/detailJadwal/<?= $data['film_id']?>';
                }
            });
        </script>
        <?php unset($data['success-tambah']); ?>
    <?php endif; ?>
</body>

</html>