<?php
require_once(dirname(__DIR__, 2) . '/models/Student.php');
$studentObj = new Student();
$students = $studentObj->getAllStudents();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center text-primary">Quản Lý Sinh Viên</h2>
        <div class="d-flex justify-content-between align-items-center my-3">
            <a href="/KiemTraGiuaKyPHP/app/views/student/create.php" class="btn btn-success">➕ Thêm Sinh Viên</a>
            <a href="register_course.php" class="btn btn-secondary btn-sm">📚 Xem Học Phần</a>

        </div>
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['MaSV']) ?></td>
                        <td><?= htmlspecialchars($student['HoTen']) ?></td>
                        <td><?= htmlspecialchars($student['GioiTinh']) ?></td>
                        <td><?= date('d/m/Y', strtotime($student['NgaySinh'])) ?></td>
                        <td>
                            <?php
                            $imagePath = !empty($student['Hinh']) ? '/KiemTraGiuaKyPHP/app/' . htmlspecialchars($student['Hinh']) : '../../uploads/default.png';
                            ?>
                            <img src="<?= $imagePath ?>" class="rounded-circle" width="50" height="50" alt="Ảnh sinh viên">
                        </td>

                        <td>
                            <a href="/KiemTraGiuaKyPHP/app/views/student/detail.php?id=<?= htmlspecialchars($student['MaSV']) ?>" class="btn btn-info btn-sm">👀 Chi Tiết</a>
                            <a href="/KiemTraGiuaKyPHP/app/views/student/edit.php?id=<?= htmlspecialchars($student['MaSV']) ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                            <a href="/KiemTraGiuaKyPHP/app/controller/StudentController.php?action=delete&id=<?= htmlspecialchars($student['MaSV']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>