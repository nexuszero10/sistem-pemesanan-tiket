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
                  kategori_id,
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

    public function getAllFilmManual(){
        $query = "SELECT film_id, judul, url_trailer, image FROM $this->table";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function updateDataFilm($data){
        $query = "UPDATE film SET
                    kategori_id = :kategori_id,
                    judul = :judul,
                    director = :director,
                    duration = :duration,
                    genre = :genre,
                    tahun_rilis = :realese,
                    cast = :cast,
                    harga = :harga,
                    synopsis = :synopsis,
                    url_trailer = :url_trailer,
                    image = :image
                  WHERE film_id = :film_id";
    
        $this->db->query($query);
        $this->db->bind(':kategori_id', $data['kategori_id']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':director', $data['director']);
        $this->db->bind(':duration', $data['duration']);
        $this->db->bind(':genre', $data['genre']);
        $this->db->bind(':realese', $data['realese']);
        $this->db->bind(':cast', $data['cast']);
        $this->db->bind(':harga', $data['harga']);
        $this->db->bind(':synopsis', $data['synopsis']);
        $this->db->bind(':url_trailer', $data['url_trailer']);
        $this->db->bind(':image', $data['inputGambar']);
        $this->db->bind(':film_id', $data['film_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataFilm($data) {
        $query = "INSERT INTO film 
                    (kategori_id, judul, director, duration, genre, tahun_rilis, cast, harga, synopsis, url_trailer, image) 
                  VALUES 
                    (:kategori_id, :judul, :director, :duration, :genre, :tahun_rilis, :cast, :harga, :synopsis, :url_trailer, :image)";
        
        $this->db->query($query);
        
        $this->db->bind(':kategori_id', $data['kategori_id']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':director', $data['director']);
        $this->db->bind(':duration', $data['duration']);
        $this->db->bind(':genre', $data['genre']);
        $this->db->bind(':tahun_rilis', $data['realese']);
        $this->db->bind(':cast', $data['cast']);
        $this->db->bind(':harga', $data['harga']);
        $this->db->bind(':synopsis', $data['synopsis']);
        $this->db->bind(':url_trailer', $data['url_trailer']);
        $this->db->bind(':image', $data['inputGambar']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }    

    public function hapusDataFilm($film_id){
        $query = "DELETE FROM $this->table WHERE film_id = :film_id;";
        $this->db->query($query);
        $this->db->bind(':film_id', $film_id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
