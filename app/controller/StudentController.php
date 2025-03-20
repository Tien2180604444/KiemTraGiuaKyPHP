<?php
require_once "../models/Student.php";

class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    // 1️⃣ Hiển thị danh sách sinh viên
    public function index()
    {
        $students = $this->studentModel->getAllStudents();
        include "../views/student/index.php";
    }

    // 2️⃣ Hiển thị chi tiết sinh viên
    public function show($id)
    {
        $student = $this->studentModel->getStudentById($id);
        include "../views/student/detail.php";
    }

    // 3️⃣ Hiển thị trang thêm sinh viên
    public function create()
    {
        include "../views/student/create.php";
    }

    // 4️⃣ Xử lý thêm sinh viên
    public function store($data)
    {
        $uploadDir = "../uploads/"; // Thư mục lưu ảnh
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa có
        }

        $imagePath = ""; // Đường dẫn lưu vào database

        if (!empty($_FILES["Hinh"]["name"])) {
            $fileName = basename($_FILES["Hinh"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Kiểm tra loại file ảnh
            $allowedTypes = ["jpg", "png", "jpeg", "gif"];
            if (in_array(strtolower($fileType), $allowedTypes)) {
                if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                    $imagePath = "uploads/" . $fileName; // Đường dẫn lưu vào database
                }
            }
        }

        // Chuẩn bị dữ liệu lưu vào DB
        $studentData = [
            "MaSV" => $data["MaSV"],
            "HoTen" => $data["HoTen"],
            "GioiTinh" => $data["GioiTinh"],
            "NgaySinh" => $data["NgaySinh"],
            "Hinh" => $imagePath, // Lưu đường dẫn ảnh vào DB
            "MaNganh" => $data["MaNganh"]
        ];

        if ($this->studentModel->createStudent($studentData)) {
            header("Location: ../views/student/index.php");
            exit();
        }
    }

    // 5️⃣ Hiển thị trang chỉnh sửa sinh viên
    public function edit($id)
    {
        $student = $this->studentModel->getStudentById($id);
        include "../views/student/edit.php";
    }

    public function update($id, $data)
{
    $studentModel = new Student();
    
    // Lấy thông tin sinh viên cũ
    $currentStudent = $studentModel->getStudentById($id);
    $Hinh = $currentStudent['Hinh']; // Giữ ảnh cũ

    // Nếu có file ảnh mới, xử lý upload
    if (!empty($_FILES['Hinh']['name'])) {
        $uploadDir = '../uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['Hinh']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = ["jpg", "png", "jpeg", "gif"];

        if (in_array(strtolower($fileType), $allowedTypes)) {
            if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFilePath)) {
                $Hinh = "uploads/" . $fileName; // Cập nhật đường dẫn ảnh
            }
        }
    }

    // Chuẩn bị dữ liệu để cập nhật
    $studentData = [
        "HoTen" => $data["HoTen"],
        "GioiTinh" => $data["GioiTinh"],
        "NgaySinh" => $data["NgaySinh"],
        "Hinh" => $Hinh, // Giữ ảnh cũ nếu không có ảnh mới
        "MaNganh" => $data["MaNganh"]
    ];

    // Gọi model để cập nhật
    if ($studentModel->updateStudent($id, $studentData)) {
        header("Location: ../views/student/index.php");
        exit();
    }
}



    // 7️⃣ Xóa sinh viên
    public function delete($id)
    {
        if ($this->studentModel->deleteStudent($id)) {
            header("../views/student/index.php");
        }
    }
}

// ⚡ Xử lý request
$studentController = new StudentController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'create':
            $studentController->create();
            break;
        case 'store':
            $studentController->store($_POST);
            break;
        case 'edit':
            $studentController->edit($_GET['id']);
            break;
        case 'update':
            $studentController->update($_GET['id'], $_POST);
            break;
        case 'delete':
            $studentController->delete($_GET['id']);
            break;
        case 'show':
            $studentController->show($_GET['id']);
            break;
        default:
            $studentController->index();
            break;
    }
} else {
    $studentController->index();
}
