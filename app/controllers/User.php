<?php

class User extends Controller
{
    public function login()
    {
        $data['file'] = 'user/login';
        $data['title'] = 'Login - Bioskop Athena';
        $data['error-login'] = null;
        $this->view('user/login', $data);
    }

    public function register()
    {
        $data['file'] = 'user/register';
        $data['title'] = 'Register - Bioskop Athena';
        $data['error-register'] = null;
        $this->view('user/register', $data);
    }

    public function registrasiAkun()
    {
        if ($_POST['password'] !== $_POST['password2']) {
            $data['file'] = 'user/register';
            $data['title'] = 'Register - Bioskop Athena';
            $data['error-register'] = 'Password harus sama!';
            $this->view('user/register', $data);
            return;
        }

        if ($this->model('User_model')->tambahDataRegistrasi($_POST) > 0) {
            $data['file'] = 'user/register';
            $data['title'] = 'Register - Bioskop Athena';
            $data['success-register'] = 'Registrasi sukses silahkan login!';
            $this->view('user/register', $data);
        } else {
            $data['file'] = 'user/register';
            $data['title'] = 'Register - Bioskop Athena';
            $data['error-register'] = 'Username sudah terdaftar!';
            $this->view('user/register', $data);
        }
    }

    public function loginAkun()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginResult = $this->model('User_model')->cekLogin($_POST);

            if (is_array($loginResult) && $loginResult['status'] == 1) {
                session_start();
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $loginResult['user_id'];
                $_SESSION['hashed_username'] = $loginResult['hashed_username'];

                if (isset($_POST['remember'])) {
                    setcookie('id', $loginResult['user_id'], time() + 60, "/");
                    setcookie('key', $loginResult['hashed_username'], time() + 60, "/");
                }

                $data['file'] = 'user/login';
                $data['title'] = 'Login - Bioskop Athena';
                $data['success-login'] = "Login sukses!";
                $this->view('user/login', $data);
            } else {
                $data['file'] = 'user/login';
                $data['title'] = 'Login - Bioskop Athena';

                if ($loginResult == -1) {
                    $data['error-login'] = "Username tidak ditemukan!";
                } elseif ($loginResult == -2) {
                    $data['error-login'] = "Password salah!";
                } else {
                    $data['error-login'] = "Login Gagal!";
                }
                $this->view('user/login', $data);
            }
        } else {
            $data['file'] = 'user/login';
            $data['title'] = 'Login - Bioskop Athena';
            $this->view('user/login', $data);
        }
    }


    public function logoutAkun()
    {
        session_start();
        session_unset();
        session_destroy();

        setcookie('id', '', time() - 3600, "/");
        setcookie('key', '', time() - 3600, "/");

        header("Location: " . BASE_URL);
        exit();
    }

    public function dashboard(){
        $this->view('user/dashboard');
    }
}
