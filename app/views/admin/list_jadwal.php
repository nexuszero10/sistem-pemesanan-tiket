    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($data['title']) ?></title>
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
                margin: auto 0;
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

            #tabelJadwal {
                width: 95%;
                margin: auto;
            }

            table {
                width: 95%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #1a1d23;
                color: #ffffff;
                text-align: center;
                border-radius: 10px;
                overflow: hidden;
                margin: 0 auto;
            }

            table thead {
                background-color: #393E46;
                color: #ffd700;
            }

            table th,
            table td {
                padding: 7.5px;
                border: 1px solid #333;
            }

            table th {
                font-weight: bold;
                text-transform: uppercase;
            }

            table tbody tr:nth-child(even) {
                background-color: #2a2f36;
            }

            table tbody tr:hover {
                background-color: #ffd700;
                color: #1b2027;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            #tabelJadwal {
                margin-bottom: 40px;
            }

            #tabelJadwal h2 {
                text-align: center;
                margin: 20px 0;
                font-size: 32px;
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

            <?php
            $dataListJadwal = $data['dataListJadwal'];
            $days = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];
            $timeSlots = ['10:00', '13:00', '16:00', '19:00'];
            $studios = ['studio 1', 'studio 2'];

            $tableData = [];
            foreach ($timeSlots as $time) {
                foreach ($studios as $studio) {
                    foreach ($days as $day) {
                        $tableData[$time][$studio][$day] = '-';
                    }
                }
            }

            foreach ($dataListJadwal as $jadwal) {
                $time = $jadwal['pukul'];
                $studio = 'studio ' . $jadwal['studio_id'];
                $day = strtoupper($jadwal['hari']);

                if (isset($tableData[$time][$studio][$day])) {
                    $tableData[$time][$studio][$day] = $jadwal['judul'];
                }
            }
            ?>

            <div id="tabelJadwal">
                <h2>Data Jadwal Film</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Jam</th>
                            <th>Studio</th>
                            <?php foreach ($days as $day): ?>
                                <th><?= $day ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tableData as $time => $studiosData): ?>
                            <?php foreach ($studiosData as $studio => $daysData): ?>
                                <tr>
                                    <td><?= $time ?></td>
                                    <td><?= $studio ?></td>
                                    <?php foreach ($days as $day): ?>
                                        <td><?= $daysData[$day] ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer>
            <div class="copyright">© 2024 Biokop Athena. All rights reserved.</div>
        </footer>
    </body>

    </html>