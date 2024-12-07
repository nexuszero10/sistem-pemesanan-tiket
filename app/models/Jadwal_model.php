<?php

class Jadwal_model
{
    private $table = 'jadwal';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getFilmSchedule($film_id)
    {
        $query = "SELECT 
                    jadwal_id,
                    film_id,
                    studio_id,
                    DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal,
                    TIME_FORMAT(pukul, '%H:%i') AS pukul,
                    hari,
                    status,
                    admin_id
                  FROM $this->table 
                  WHERE film_id = :film_id";
        $this->db->query($query);
        $this->db->bind(':film_id', $film_id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getSpecificSchedule($jadwal_id)
    {
        $query = "SELECT jadwal_id, film_id, studio_id, DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal, TIME_FORMAT(pukul, '%H:%i') AS pukul, hari, status, admin_id
                    FROM $this->table 
                    WHERE jadwal_id = :jadwal_id";
        $this->db->query($query);
        $this->db->bind(':jadwal_id', $jadwal_id);
        return $this->db->single();
    }
}
