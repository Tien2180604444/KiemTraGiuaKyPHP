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
    <h2 class="my-4 text-center">Sửa Thông Tin Sinh Viên</h2>
    <form action="/KiemTraGiuaKyPHP/app/controller/StudentController.php?action=update&id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="<?= $student['HoTen'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam" <?= ($student['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= ($student['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" value="<?= $student['NgaySinh'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Hình Ảnh:</label>
            <br>
            <?php
            $imagePath = !empty($student['Hinh']) ? '/KiemTraGiuaKyPHP/app/' . htmlspecialchars($student['Hinh']) : '../../uploads/default.png';
            ?>
            <img src="<?= $imagePath ?>" class="rounded-circle" width="100" height="100" alt="Ảnh sinh viên">
            <input type="file" name="Hinh" class="form-control">
        </div>
        <div class="mb-3">
            <label>Mã Ngành:</label>
            <input type="text" name="MaNganh" value="<?= $student['MaNganh'] ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>