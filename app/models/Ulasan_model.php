<?php

class Ulasan_model{
    private $table = "ulasan";
    private $db ;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSpesificReview($film_id){
        $query = "SELECT ulasan.*, user.username 
                  FROM $this->table 
                  INNER JOIN user ON ulasan.user_id = user.user_id 
                  WHERE ulasan.film_id = :film_id";
    
        $this->db->query($query);
        $this->db->bind(':film_id', $film_id);
        $this->db->execute();
        return $this->db->resultSet();
    }
    

    public function tambahUlasan($data) {
        $query = "INSERT INTO ulasan (user_id, film_id, rating, komentar, tanggal)
                  VALUES (:user_id, :film_id, :rating, :komentar, :tanggal)";

        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':film_id', $data['film_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':komentar', $data['komentar']);
        $this->db->bind(':tanggal', $data['tanggal']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}