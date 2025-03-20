<?php
session_start();
require_once '../../config/database.php';
require_once '../../models/Student.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST["MaSV"];

    // Tạo đối tượng Student
    $studentModel = new Student($conn);
    $student = $studentModel->getStudentById($MaSV);

    if ($student) {
        // Lưu session đăng nhập
        $_SESSION["user_id"] = $student["MaSV"];
        $_SESSION["user_name"] = $student["HoTen"];

        // Chuyển hướng đến trang index
        header("Location: index.php");
        exit();
    } else {
        $error = "Mã sinh viên không tồn tại!";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">ĐĂNG NHẬP</h2>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label>Mã SV:</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            <a href="index.php" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
</body>
</html>
