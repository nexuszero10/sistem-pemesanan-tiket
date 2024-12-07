<?php

class Home extends Controller {

    // ketika tidak menuliskan apapun di url method ini dipanggil
    public function index(){        

        // memanggil methods views pada core/controllers
        // folder views -> subfolder home ->file index 
        $data['title'] = "Beranda - Bioskop Athena";
        $this->view('home/index', $data);
    }
}