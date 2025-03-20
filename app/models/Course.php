<?php
class Course {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCourses() {
        $query = "SELECT * FROM hocphan";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourseById($id) {
        $query = "SELECT * FROM hocphan WHERE MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaHP", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
