<?php
class Database {
    private $host = "localhost";
    private $db_name = "Test1"; // Tên database
    private $username = "root"; // Tài khoản mặc định của XAMPP
    private $password = ""; // XAMPP mặc định để trống
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Lỗi kết nối: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
