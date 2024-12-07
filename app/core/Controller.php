<?php

class Controller {

    // method view dipanggil oleh folder controllers
    // mencari view berdasarkan parameter $view (folder/file)
    public function view($view, $data = []){

        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    // method models untuk mengelola models
    public function model($model){
        require_once __DIR__ . '/../models/' . $model . '.php';

        // harus return object agar bisa akses methods class User_model
        return new $model;
    }
}