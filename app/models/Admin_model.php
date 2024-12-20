<?php

class Admin_model {
    private $table = 'admin';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function cekLogin($data) {
        $username = trim(strtolower(stripslashes($data['username'])));
        $password = trim($data['password']);
    
        $query = "SELECT * FROM $this->table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->execute();
    
        if ($this->db->rowCount() == 1) {
            $user = $this->db->single();
    
            if ($password === $user['password']) {
                return [
                    'status' => 1,
                    'admin_id' => $user['admin_id'],
                    'hashed_username' => hash('sha256', $user['username'])
                ];
            } else {
                return -2;
            }
        } else {
            return -1;
        }
    }
}
