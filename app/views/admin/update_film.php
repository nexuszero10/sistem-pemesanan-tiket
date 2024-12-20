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
            width: 85%;
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

        #infoFilm table {
            width: 100%;
            font-size: 15px;
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

        <form id="containerMovie" method="post" action="<?= BASE_URL ?>film/updateDataFilm/" enctype="multipart/form-data">
            <input type="hidden" name="inputId" value="<?= $data['dataDetailFilm']['film_id'] ?>">
            <input type="hidden" name="inputGambarLama" value="<?= ($data['dataDetailFilm']['image']) ?>">
            <div id="posterFilm">
                <img src="<?= BASE_URL . '/img/film/' . ($data['dataDetailFilm']['image']) ?>" alt="<?= str_replace(' ', '', strtolower($data['dataDetailFilm']['judul'])) . ".png"; ?>">
                <div id="listButton">
                    <a href="<?= BASE_URL ?>film/updateFilm/<?= trim($data['dataDetailFilm']['film_id']) ?>"><button id="editFilm">Update Data Film</button></a>
                </div>
            </div>

            <div id="infoFilm">
                <table cellpadding="4.5px" style="font-size: 16.5px;">
                    <tr>
                        <td><label for="inputJudul">Judul</label></td>
                        <td>:</td>
                        <td><input type="text" id="inputJudul" name="inputJudul" value="<?= $data['dataDetailFilm']['judul'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <?php
                        $kategoriMap = [
                            1 => 'Jepang',
                            2 => 'Barat',
                            3 => 'Lainnya'
                        ];
                        $currentKategoriId = $data['dataDetailFilm']['kategori_id'];
                        ?>
                        <td>
                            <select name="inputKategori" id="inputKategori" required>
                                <?php
                                foreach ($kategoriMap as $kategoriId => $kategoriName) {
                                    $selected = ($currentKategoriId == $kategoriId) ? 'selected' : '';
                                    echo "<option value='$kategoriId' $selected>$kategoriName</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="inputDirector">Director</label></td>
                        <td>:</td>
                        <td><input type="text" id="inputDirector" name="inputDirector" value="<?= $data['dataDetailFilm']['director'] ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="inputDuration">Duration</label></td>
                        <td>:</td>
                        <td><input type="number" id="inputDuration" name="inputDuration" value="<?= $data['dataDetailFilm']['duration'] ?>" required min="0"></td>
                    </tr>
                    <tr>
                        <td><label for="inputGenre">Genre</label></td>
                        <td>:</td>
                        <td><input type="text" id="inputGenre" name="inputGenre" value="<?= $data['dataDetailFilm']['genre'] ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="inputRealese">Realese</label></td>
                        <td>:</td>
                        <td><input type="number" id="inputRealese" name="inputRealese" value="<?= $data['dataDetailFilm']['tahun_rilis'] ?>" required min="0"></td>
                    </tr>
                    <tr>
                        <td><label for="inputCast">Cast</label></td>
                        <td>:</td>
                        <td><input type="text" id="inputCast" name="inputCast" value="<?= $data['dataDetailFilm']['cast'] ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="inputHarga">Price</label></td>
                        <td>:</td>
                        <td><input type="number" id="inputHarga" name="inputHarga" value="<?= $data['dataDetailFilm']['harga'] ?>" required min="0"></td>
                    </tr>
                    <tr>
                        <td><label for="inputURL">URL Trailer</label></td>
                        <td>:</td>
                        <td><input type="text" id="inputURL" name="inputURL" value="<?= $data['dataDetailFilm']['url_trailer'] ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="inputGambar">Poster film</label></td>
                        <td>:</td>
                        <td><input type="file" name="inputGambar" id="inputGambar"></td>
                    </tr>
                    <tr>
                        <td><label for="inputSynopsis">Synopsis</label></td>
                        <td>:</td>
                    </tr>
                </table>
                <textarea name="inputSynopsis" id="inputSynopsis" rows="5"><?= trim($data['dataDetailFilm']['synopsis']) ?></textarea>
            </div>
        </form>

        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>

    <?php if (isset($data['error-upload'])): ?>
        <script>
            Swal.fire({
                title: 'Gagal Update Data!',
                text: '<?= htmlspecialchars($data['error-upload']) ?>',
                icon: 'error',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>/film/updateFilm/<?= $data['film_id'] ?>';
                }
            });
        </script>
    <?php endif; ?>

    <?php if (isset($data['success-upload'])): ?>
        <script>
            Swal.fire({
                title: 'Update Data Berhasil!',
                text: '<?= htmlspecialchars($data['success-upload']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>/film/updateFilm/<?= $data['film_id'] ?>';
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>