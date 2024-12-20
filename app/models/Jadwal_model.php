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

    public function getSpesificJadwal($film_id)
    {
        $query = "SELECT 
                  jadwal_id,
                  film_id,
                  studio_id,
                  tanggal,
                  pukul,
                  hari,
                  kapasitas_studio
              FROM $this->table 
              WHERE film_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $film_id);
        return $this->db->resultSet();
    }

    public function getSpesififcJadwalVanila($jadwal_id)
    {
        $query = "SELECT
                    jadwal_id,
                    film_id,
                    studio_id, 
                    tanggal,
                    pukul,
                    hari,
                    kapasitas_studio
                FROM $this->table
                WHERE jadwal_id = :jadwal_id";
        $this->db->query($query);
        $this->db->bind(':jadwal_id', $jadwal_id);
        return $this->db->single();
    }

    public function cekjadwal($hari, $pukul, $studio_id)
    {
        $query = "SELECT hari, pukul, studio_id FROM $this->table
                    WHERE hari = :hari AND pukul = :pukul AND $studio_id =:studio_id;";
        $this->db->query($query);
        $this->db->bind(':hari', $hari);
        $this->db->bind(':pukul', $pukul);
        $this->db->bind(':studio_id', $studio_id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateDataJadwal($data)
    {
        $query = "UPDATE $this->table 
                  SET film_id = :film_id, 
                      studio_id = :studio_id, 
                      tanggal = :tanggal, 
                      pukul = :pukul, 
                      hari = :hari, 
                      kapasitas_studio = :kapasitas_studio
                  WHERE jadwal_id = :jadwal_id";
        $this->db->query($query);
        $this->db->bind(':film_id', $data['film_id']);
        $this->db->bind(':studio_id', $data['studio_id']);
        $this->db->bind(':tanggal', $data['tanggal']);
        $this->db->bind(':pukul', $data['pukul']);
        $this->db->bind(':hari', $data['hari']);
        $this->db->bind(':kapasitas_studio', $data['kapasitas_studio']);
        $this->db->bind(':jadwal_id', $data['jadwal_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataJadwal($data)
    {
        $query = "INSERT INTO jadwal (film_id, studio_id, tanggal, pukul, hari, kapasitas_studio) 
              VALUES (:film_id, :studio_id, :tanggal, :pukul, :hari, :kapasitas_studio)";
        $this->db->query($query);
        $this->db->bind('film_id', $data['film_id']);
        $this->db->bind('studio_id', $data['studio_id']);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('pukul', $data['pukul']);
        $this->db->bind('hari', $data['hari']);
        $this->db->bind('kapasitas_studio', $data['kapasitas_studio']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataJadwal($jadwal_id){
        $query = "DELETE FROM $this->table WHERE jadwal_id = :jadwal_id";
        $this->db->query($query);
        $this->db->bind(':jadwal_id', $jadwal_id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllJadwal() {
        $query = "SELECT 
                    j.studio_id, 
                    TIME_FORMAT(pukul, '%H:%i') AS pukul,
                    j.hari, 
                    f.judul
                  FROM jadwal j
                  JOIN film f ON j.film_id = f.film_id
                ";
                  
        $this->db->query($query);
        return $this->db->resultSet();
    }
    
}
