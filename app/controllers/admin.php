<?php

class Admin extends Controller {

    public function index(){
        $data['title'] = "Login Admin - Bioskop Athena";
        $this->view('admin/index', $data);
    }

    public function kelola(){
        $data['title'] = "Kelola - Bioskop Athena";
        $data['semuaFilm'] = $this->model('Film_model')->getAllFilmManual();
        $this->view('admin/kelola', $data);
    }

    public function loginAkun()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginResult = $this->model('Admin_model')->cekLogin($_POST);

            if (is_array($loginResult) && $loginResult['status'] == 1) {
                session_start();
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $loginResult['admin_id'];
                $_SESSION['hashed_username'] = $loginResult['hashed_username'];

                $data['title'] = 'Login Admin - Bioskop Athena';
                $data['success-login'] = "Login sukses!";
                $this->view('admin/index', $data);
            } else {
                $data['title'] = 'Login Admin - Bioskop Athena';

                if ($loginResult == -1) {
                    $data['error-login'] = "Username tidak ditemukan!";
                } elseif ($loginResult == -2) {
                    $data['error-login'] = "Password salah!";
                } else {
                    $data['error-login'] = "Login Gagal!";
                }
                $this->view('admin/index', $data);
            }
        } else {
            $data['title'] = 'Login Admin - Bioskop Athena';
            $this->view('admin/index', $data);
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header("Location: " . $this->index());
        exit();
    }
}
