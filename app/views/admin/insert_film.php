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
            margin-bottom: 20px;
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
        }

        #infoFilm {
            display: flex;
            flex-direction: column;
            flex: 2.25;
            padding: 20px;
            background-color: #1E222A;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #FFFFFF;
            font-family: 'Arial', sans-serif;
            border: 1px solid #ffd700;
        }

        #infoFilm * {
            margin: 5px 0;
        }

        #infoFilm h1 {
            font-size: 30px;
            color: #FFD700;
            letter-spacing: 1.5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .baris {
            display: flex;
            flex-direction: row;
            gap: 12.5px;
            margin-bottom: 15px;
        }

        .baris * {
            flex: 1;
            background-color: #3A3F47;
            outline: none;
            border: none;
            padding: 10px;
            border-radius: 7.5px;
            color: #FFFFFF;
            font-size: 14px;
        }

        .baris select,
        .baris input,
        #infoFilm textarea {
            transition: 0.3s ease;
        }

        .baris input::placeholder,
        .baris select::placeholder,
        #infoFilm textarea::placeholder {
            color: #FFFFFF;
            opacity: 0.8;
        }

        #infoFilm textarea {
            resize: none;
            background-color: #3A3F47;
            color: #FFFFFF;
            padding: 10px;
            border-radius: 7.5px;
            border: none;
            font-size: 14px;
            outline: none;
        }

        #infoFilm input[type="file"] {
            margin-bottom: 15px;
            color: #FFFFFF;
        }

        #infoFilm button {
            background-color: #FFD700;
            color: #1E222A;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s ease;
            align-self: center;
        }

        #infoFilm button:hover {
            scale: 1.1;
            transition: 0.5s ease-in-out;
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

        <form id="containerMovie" method="post" action="<?= BASE_URL ?>film/tambahDataFilm/" enctype="multipart/form-data">
            <div id="infoFilm">
                <h1>Masukkan Data Film</h1>
                <div class="baris">
                    <input
                        type="text"
                        id="inputJudul"
                        name="inputJudul"
                        placeholder="Masukkan judul film"
                        value="<?= isset($data['judul']) ? htmlspecialchars($data['judul']) : '' ?>"
                        required>
                    <select name="inputKategori" id="inputKategori" required>
                        <option value="" <?= !isset($data['kategori_id']) ? 'selected' : '' ?>>Pilih kategori film</option>
                        <option value="1" <?= isset($data['kategori_id']) && $data['kategori_id'] == 1 ? 'selected' : '' ?>>Jepang</option>
                        <option value="2" <?= isset($data['kategori_id']) && $data['kategori_id'] == 2 ? 'selected' : '' ?>>Barat</option>
                        <option value="3" <?= isset($data['kategori_id']) && $data['kategori_id'] == 3 ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                    <input
                        type="text"
                        id="inputDirector"
                        name="inputDirector"
                        placeholder="Masukkan director film"
                        value="<?= isset($data['director']) ? htmlspecialchars($data['director']) : '' ?>"
                        required>
                </div>
                <div class="baris">
                    <input
                        type="text"
                        id="inputGenre"
                        name="inputGenre"
                        placeholder="Masukkan genre film (dipisah koma)"
                        value="<?= isset($data['genre']) ? htmlspecialchars($data['genre']) : '' ?>"
                        required>
                    <input
                        type="text"
                        id="inputCast"
                        name="inputCast"
                        placeholder="Masukkan cast film (dipisah koma)"
                        value="<?= isset($data['cast']) ? htmlspecialchars($data['cast']) : '' ?>"
                        required>
                    <input
                        type="text"
                        id="inputURL"
                        name="inputURL"
                        placeholder="Masukkan url film (youtube)"
                        value="<?= isset($data['trailer']) ? htmlspecialchars($data['trailer']) : '' ?>"
                        required>
                </div>
                <div class="baris">
                    <input
                        type="number"
                        id="inputDuration"
                        name="inputDuration"
                        placeholder="Masukkan durasi film"
                        value="<?= isset($data['duration']) ? htmlspecialchars($data['duration']) : '' ?>"
                        required
                        min="0">
                    <input
                        type="number"
                        id="inputHarga"
                        name="inputHarga"
                        placeholder="Masukkan harga tiket"
                        value="<?= isset($data['harga']) ? htmlspecialchars($data['harga']) : '' ?>"
                        required
                        min="0">
                    <input
                        type="number"
                        id="inputRealese"
                        name="inputRealese"
                        placeholder="Masukkan tahun rilis film"
                        value="<?= isset($data['realese']) ? htmlspecialchars($data['realese']) : '' ?>"
                        required
                        min="0">
                </div>
                <textarea
                    name="inputSynopsis"
                    id="inputSynopsis"
                    rows="5"
                    style="width: 97.5%;"
                    required><?= isset($data['synopsis']) ? htmlspecialchars($data['synopsis']) : 'Masukkan synopsis film' ?></textarea>
                <input type="file" name="inputGambar" id="inputGambar" <?= !isset($data['gambarLama']) ? 'required' : '' ?> style="width: 30%">
                <button type="submit">Insert Film</button>
            </div>
        </form>
                
        <footer>
            <div class="optionalPage">
            </div>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </div>
    <?php if (isset($data['error-tambah'])): ?>
        <script>
            Swal.fire({
                title: 'Tambah Data Film Gagal!',
                text: '<?= htmlspecialchars($data['error-tambah']) ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
        <?php unset($data['error-tambah']) ?>
    <?php endif; ?>

    <?php if (isset($data['success-tambah'])): ?>
        <script>
            Swal.fire({
                title: 'Tambah Data Film berhasil!',
                text: '<?= htmlspecialchars($data['success-tambah']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>admin/kelola';
                }
            });
        </script>
        <?php unset($data['success-tambah']) ?>
    <?php endif; ?>
</body>

</html>