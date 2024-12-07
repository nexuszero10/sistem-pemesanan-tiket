<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="icon" href="<?= BASE_URL ?>img/home/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/user/login_3.css">
</head>

<body>
    <div id="container">
        <header>
            <div id="title">
                <a href="<?php echo BASE_URL ?>"><img src="<?= BASE_URL ?>img/home/logo.png" alt="logoAthena"></a>
                <h1>BIOSKOP ATHENA</h1>
            </div>
            <nav>
                <ul>
                    <a href="<?= BASE_URL ?>film/">
                        <li>Movies</li>
                    </a>
                    <a href="<?= BASE_URL ?>tiket/ticketing/">
                        <li>Ticketing</li>
                    </a>
                    <a href="<?= BASE_URL ?>user/login/">
                        <li>Login</li>
                    </a>
                    <a href="<?= BASE_URL ?>user/register/">
                        <li>Register</li>
                    </a>
                </ul>
            </nav>
        </header>

        <div id="loginContainer">
            <h1>Login</h1>
            <form action="<?= BASE_URL ?>user/loginAkun/" method="post" id="loginForm">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
                <button type="submit" name="submitLogin">Login</button>
                <div class="optionLogin">
                    <div class="cookieCheckbox">
                        <input type="checkbox" name="remember" id="rememberMe">
                        <label for="rememberMe">Remember Me</label>
                    </div>
                </div>
            </form>
            <a href="<?= BASE_URL ?>user/register/">Belum punya akun ? Regstrasi</a>
        </div>

    </div>

    <?php if (isset($data['error-login'])): ?>
        <script>
            Swal.fire({
                title: 'Gagal Login!',
                text: '<?= htmlspecialchars($data['error-login']) ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

    <?php if (isset($data['success-login'])): ?>
        <script>
            Swal.fire({
                title: 'Login Berhasil!',
                text: '<?= htmlspecialchars($data['success-login']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>';
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>