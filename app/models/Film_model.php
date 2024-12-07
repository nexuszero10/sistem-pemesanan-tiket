<?php

class Film_model{
    private $table = "film";
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getSpesificFilm($film_id){
        $query = "SELECT 
                  film_id,
                  judul,
                  director,
                  genre,
                  duration,
                  cast,
                  synopsis,
                  harga,
                  tahun_rilis,
                  url_trailer,
                  image
              FROM $this->table 
              WHERE film_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $film_id);
        $this->db->execute();
        return $this->db->single();
    }


    public function getRowFilm($limit, $offset){
        $query = "SELECT film_id, judul, url_trailer, image FROM $this->table LIMIT :limit OFFSET :offset";
        $this->db->query($query);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getAllFilm(){
        $semuaFilm = [];
        $jumlahBaris = 4;
        $jumlahFilmPerBaris = 4;

        for ($i = 0; $i < $jumlahBaris; $i++) {
            $offset = $i * $jumlahFilmPerBaris;
            $filmBaris = $this->getRowFilm($jumlahFilmPerBaris, $offset);

            $baris = [];
            foreach ($filmBaris as $index => $film) {
                $baris["film" . ($index + 1)] = $film;
            }

            $semuaFilm["baris" . ($i + 1)] = $baris;
        }

        return $semuaFilm;
    }
}
