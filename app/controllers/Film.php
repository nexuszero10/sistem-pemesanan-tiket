<?php
// controller film
class Film extends Controller {
    public function index (){
        $data['file'] = 'film/film_3';
        $data['title'] = 'Katalog - Bioskop Athena';
        $data['semuaFilm'] = $this->model('Film_model')->getAllFilmManual();
        $this->view('film/index', $data);
    }

    public function detail($idFilm){
        $data['dataDetailFilm'] = $this->model('Film_model')->getSpesificFilm((int)$idFilm);
        $data['dataJadwalFilm'] = $this->model('Jadwal_model')->getFilmSchedule((int)$idFilm);
        $data['dataUlasanFilm'] = $this->model('Ulasan_model')->getSpesificReview((int)$idFilm);
        $data['file'] = 'film/detail_3';
        $data['title'] = $data['dataDetailFilm']['judul'] . " - Bioskop Athena";
        $this->view('film/detail', $data);
    }
}