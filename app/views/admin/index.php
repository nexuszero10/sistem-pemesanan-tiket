<?php

session_start();

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: " . BASE_URL . "admin/kelola/");
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            box-sizing: border-box;
            background-color: #1b2027;
            color: #ffffff;
        }

        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
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

        #loginContainer * {
            padding: 0;
            margin: 0;
        }

        #loginContainer {
            background-color: #222831;
            display: flex;
            flex-direction: column;
            width: 30%;
            align-items: center;
            justify-content: center;
            gap: 15px;
            border-radius: 20px;
            min-height: 400px;
            padding: 20px;
            border: 1px solid #FFDB00;
            margin: aut;
        }

        #loginContainer h1 {
            font-size: 40px;
            letter-spacing: 2.5px;
            margin-bottom: 20px;
            color: #ffd700;
        }

        #loginForm {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 85%;
            gap: 15px;
            margin-bottom: 10px;
        }

        #loginForm input::placeholder {
            color: #fff;
        }

        #loginForm input {
            border: 1px solid #ffd700;
            padding: 12px 10px;
            border-radius: 5px;
            background-color: rgb(57, 62, 70);
            color: #ffffff;
            width: 100%;
            font-size: 16px;
            transition: 0.3s ease;
        }

        #loginForm input:focus {
            outline: none;
            border-color: #FFDB00;
            box-shadow: 0px 0px 8px rgba(255, 219, 0, 0.6);
        }

        #loginForm button {
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            color: #222831;
            background-color: #ffd700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #loginForm button:hover {
            background-color: #FFDB00;
        }

        #loginContainer a {
            font-size: 15px;
            color: white;
            letter-spacing: 1px;
        }

        #loginContainer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="loginContainer">
            <h1>Login</h1>
            <form action="<?= BASE_URL ?>admin/loginAkun/" method="post" id="loginForm">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" name="submitLogin">Login</button>
            </form>
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
        <?php unset($data['error-login']) ?>
    <?php endif; ?>

    <?php if (isset($data['success-login'])): ?>
        <script>
            Swal.fire({
                title: 'Login Berhasil!',
                text: '<?= htmlspecialchars($data['success-login']) ?>',
                icon: 'success',
                confirmButtonText: 'OK',
                willClose: () => {
                    window.location.href = '<?= BASE_URL ?>admin/kelola/';
                }
            });
        </script>
        <?php unset($data['success-login']) ?>
    <?php endif; ?>
</body>

</html>