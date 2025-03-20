<?php
require_once __DIR__ . '/../config/Database.php';

class Student {
    private $conn;
    private $table = "SinhVien";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllStudents() {
        $query = "SELECT * FROM SinhVien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentById($id) {
        $query = "SELECT * FROM SinhVien WHERE MaSV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createStudent($data) {
        $query = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function updateStudent($id, $data) {
        $query = "UPDATE SinhVien SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, MaNganh = :MaNganh";
    
        // Nếu có ảnh mới, thêm vào câu lệnh SQL
        if (!empty($data['Hinh'])) {
            $query .= ", Hinh = :Hinh";
        }
    
        $query .= " WHERE MaSV = :MaSV";
    
        $stmt = $this->conn->prepare($query);
    
        // Đảm bảo MaSV luôn tồn tại
        $data["MaSV"] = $id;
    
        // Nếu không có ảnh mới, loại bỏ Hinh khỏi dữ liệu để tránh lỗi SQL
        if (empty($data['Hinh'])) {
            unset($data['Hinh']);
        }
    
        return $stmt->execute($data);
    }
    
    
    public function deleteStudent($id) {
        $query = "DELETE FROM SinhVien WHERE MaSV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
