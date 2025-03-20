<?php
require_once '../../models/Student.php';

$studentModel = new Student();
$id = $_GET['id'];
$student = $studentModel->getStudentById($id);
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
    <h2 class="my-4 text-center">Thông Tin Chi Tiết Sinh Viên</h2>
    <table class="table table-bordered">
        <tr>
            <th>Mã Sinh Viên</th>
            <td><?= $student['MaSV'] ?></td>
        </tr>
        <tr>
            <th>Họ Tên</th>
            <td><?= $student['HoTen'] ?></td>
        </tr>
        <tr>
            <th>Giới Tính</th>
            <td><?= $student['GioiTinh'] ?></td>
        </tr>
        <tr>
            <th>Ngày Sinh</th>
            <td><?= $student['NgaySinh'] ?></td>
        </tr>
        <div class="mb-3">
            <label>Hình Ảnh:</label>
            <br>
            <?php
            $imagePath = !empty($student['Hinh']) ? '/KiemTraGiuaKyPHP/app/' . htmlspecialchars($student['Hinh']) : '../../uploads/default.png';
            ?>
            <img src="<?= $imagePath ?>" class="rounded-circle" width="100" height="100" alt="Ảnh sinh viên">
            <input type="text" name="Hinh" value="<?= $student['Hinh'] ?>" class="form-control">
        </div>

        <tr>
            <th>Mã Ngành</th>
            <td><?= $student['MaNganh'] ?></td>
        </tr>
    </table>
    <a href="index.php" class="btn btn-secondary">Quay Lại</a>
</div>