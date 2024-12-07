<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/user/register_3.css">
    <link rel="icon" href="<?= BASE_URL ?>img/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                    <li><a href="<?= BASE_URL ?>user/login/">Login</a></li>
                    <li><a href="<?= BASE_URL ?>user/register/">Register</a></li>
                </ul>
            </nav>
        </header>

        <div id="registerContainer">
            <h1>Register</h1>
            <form action="<?= BASE_URL ?>user/registrasiAkun/" method="post" id="registerForm">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="password2" id="password2" placeholder="Ulangi Password" required>
                <button type="submit" name="submitRegister">Register</button>
            </form>
            <a href="<?= BASE_URL ?>user/login/">Sudah punya akun? Login</a>
        </div>
    </div>

    <?php if (isset($data['error-register'])): ?>
        <script>
            Swal.fire({
                title: 'Gagal Registrasi!',
                text: '<?= htmlspecialchars($data['error-register']) ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

    <?php if (isset($data['success-register'])): ?>
        <script>
            Swal.fire({
                title: 'Registrasi Berhasil!',
                text: '<?= htmlspecialchars($data['success-register']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>user/login';
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>
