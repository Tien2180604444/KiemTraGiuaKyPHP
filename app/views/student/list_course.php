    <?php
    require_once(dirname(__DIR__, 2) . '/models/Course.php');
    $courseObj = new Course();
    $courses = $courseObj->getAllCourses();
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh Sách Học Phần</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="text-center text-primary">Danh Sách Học Phần</h2>
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?= htmlspecialchars($course['MaHP']) ?></td>
                            <td><?= htmlspecialchars($course['TenHP']) ?></td>
                            <td><?= htmlspecialchars($course['SoTinChi']) ?></td>
                            <td>
                                <a href="CourseController.php?action=detail&MaHP=<?= htmlspecialchars($course['MaHP']) ?>" class="btn btn-info btn-sm">👀 Xem</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
