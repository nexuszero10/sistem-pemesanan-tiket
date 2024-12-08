<?php

class Tiket_model
{
    private $table = "tiket";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // fungsi untuk mengecek apakah ada tiket apda jadwal film 
    public function getTiketByJadwalId($jadwal_id)
    {
        $query = "SELECT * FROM $this->table WHERE jadwal_id = :jadwal_id";
        $this->db->query($query);
        $this->db->bind(':jadwal_id', $jadwal_id);
        $this->db->execute();

        if ($this->db->rowCount() == 1) {
            return $this->db->single();
        } else {
            return $this->db->resultSet();
        }
    }

    // fungsi gabung row dan seat number
    public function getOccupiedSeatsByJadwalId($jadwal_id)
    {
        $query = "SELECT CONCAT(baris_kursi, nomor_kursi) AS seat 
                  FROM $this->table 
                  WHERE jadwal_id = :jadwal_id AND status_tiket = 'success'";
        $this->db->query($query);
        $this->db->bind(':jadwal_id', $jadwal_id);
        $this->db->execute();

        if ($this->db->rowCount() == 1) {
            return $this->db->single();
        } else {
            return $this->db->resultSet();
        }
    }

    // fungsi insert data ke tiket
    public function tambahDataTiket($data)
    {
        $query = "INSERT INTO $this->table (user_id, jadwal_id, baris_kursi, nomor_kursi, status_tiket, order_id)
              VALUES (:user_id, :jadwal_id, :baris_kursi, :nomor_kursi, :status_tiket, :order_id)";

        // Menjalankan query
        $this->db->query($query);

        // Binding data
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':jadwal_id', $data['jadwal_id']);
        $this->db->bind(':baris_kursi', $data['baris_kursi']);
        $this->db->bind(':nomor_kursi', $data['nomor_kursi']);
        $this->db->bind(':status_tiket', $data['status_tiket']);
        $this->db->bind(':order_id', $data['order_id']);

        // Eksekusi dan cek hasilnya
        if ($this->db->execute()) {
            return $this->db->rowCount();
        } else {
            return false;  // Jika gagal, bisa ditangani sesuai kebutuhan
        }
    }

    // fungsi apah user pernak beli tiket berdasarkan film_id dan user_id
    public function checkUserBuy($user_id, $film_id){
        $query = "SELECT order_id 
        FROM tiket t 
        JOIN jadwal j ON t.jadwal_id = j.jadwal_id 
        JOIN film f ON j.film_id = f.film_id 
        WHERE t.user_id = :user_id AND f.film_id = :film_id";    
        
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':film_id', $film_id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function tiketUserBeli($user_id) {
        $query = "
            SELECT f.film_id, 
                   f.judul AS judul_film, 
                   t.order_id, 
                   COUNT(*) AS jumlah_tiket
            FROM tiket t
            JOIN jadwal j ON t.jadwal_id = j.jadwal_id
            JOIN film f ON j.film_id = f.film_id
            WHERE t.user_id = :user_id
            GROUP BY f.film_id, f.judul, t.order_id;
        ";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
    
        $result = $this->db->resultSet();
    
        return [
            'data' => $result,
            'row_count' => $this->db->rowCount()
        ];
    }    
}
