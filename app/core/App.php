<?php

// objeck class app akan dibuat ketika membuka file index.php pada folder public
class App {

    // project-ads-athena/public/controller/method/param1/param2

    // controller, method, dan param default
    protected $controller = 'home';
    protected $method = 'index';
    protected $param = [];

    public function __construct()
    {
        // memanggil fungsi parseURL untuk mendapatkan controller dan method pada url
        $url = $this->parseURL();
        
        // mengecek apakah url controller pada folder controllers
        if(isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')){

            // jika ada set properti controllers 
            $this->controller = $url[0];
            // menghapus controller dari array url
            unset($url[0]);
        }

        // memanggil controller yang sudah ada
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        
        // membuat object dari class controller
        $this->controller = new $this->controller;

        // cek apakah method ada di controllers
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){

                // jika ada set peorperti method 
                $this->method = $url[1];

                // menghapus method dari array url
                unset($url[1]);
            }
        }

        // handle parameter -> mengecek apakah ada parameter atau tidak
        if(!empty($url)){

            // set properti param dengan isi dari $url
            $this->param = array_values($url);
        }

        // jalankan controller & method serta kirimkan param jika ada
        // [object, function], paramater
        call_user_func_array([$this->controller, $this->method], $this->param);

    }

    // fungsi untuk mendapatkan url -> setelah folder public 
    public function parseURL(){
        if (isset($_GET['url'])){

            // untuk menghilangknag '/' terakhir pada url
            $url = rtrim($_GET['url'], '/');

            $url = filter_var($url, FILTER_SANITIZE_URL);

            // splitter dengan delimiter '/' dan return array
            $url = explode('/', $url);

            // return array url jika menang ada url
            return $url ;
        }

        // return array kosong jika tidak ada url 
        return [];

    }
}