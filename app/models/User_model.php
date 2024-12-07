<?php
class User_model {
    private $table = "user";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tambahDataRegistrasi($data) {
        $username = trim(strtolower(stripslashes($data['username'])));
        $password = str_replace(' ', '', trim($data['password']));

        // Cek apakah username sudah ada
        $query = "SELECT username FROM $this->table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->execute();
        
        if ($this->db->rowCount() > 0) {
            return false; // Username sudah ada
        }

        // Enkripsi password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru ke dalam database
        $query = "INSERT INTO $this->table (username, password) VALUES (:username, :password)";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':password',    $passwordHash);
        $this->db->execute();
        
        return $this->db->rowCount(); 
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
    
            if (password_verify($password, $user['password'])) {
                return [
                    'status' => 1,
                    'user_id' => $user['user_id'],
                    'hashed_username' => hash('sha256', $user['username'])
                ];
            } else {
                return -2;
            }
        } else {
            return -1;
        }
    }

    // Add getUserById method
    public function getUserById($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        return $this->db->single();
    }
}
?>
