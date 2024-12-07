<?php
//databse class
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $db_name = DB_NAME;

    private $dbh; // variabel yang mewakili koneksi database
    private $statement; // variabele yang meenyinppan reeturn darri ppdo preepparree statment

    // ketika object db dibuat akan melakukan koneksi databse 
    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $option);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // method untuk melakukan query select ke database
    public function query($query) {
        $this->statement = $this->dbh->prepare($query);
    }

    // mehthod untuk binding value parameter 
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_string($value):
                    // Memeriksa tipe data string tambahan yang mungkin ada di database Anda.
                    // Tipe DATE, TIME, YEAR dan VARCHAR di sini tetap menggunakan PDO::PARAM_STR
                    if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $value)) { // Format TIME (HH:MM:SS)
                        $type = PDO::PARAM_STR;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        
        $this->statement->bindValue($param, $value, $type);
    }
    

    // method execute setelah prepare dan binding
    public function execute() {
        return $this->statement->execute();
    }
    // method untuk mendatpatkan semua baaris 
    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // method untuk mendaptkan baris pertama
    public function single() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    // method untuk menghitung baris yang ter-effect sebiah query
    public function rowCount() {
        return $this->statement->rowCount();
    }
}
