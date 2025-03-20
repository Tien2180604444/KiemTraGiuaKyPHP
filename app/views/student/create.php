<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
    <h2 class="my-4 text-center">Thêm Sinh Viên</h2>
    <form action="/KiemTraGiuaKyPHP/app/controller/StudentController.php?action=store" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Mã SV:</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control">
        </div>
        <div class="mb-3">
            <label>Hình Ảnh:</label>
            <input type="file" name="Hinh" class="form-control">
        </div>
        <div class="mb-3">
            <label>Mã Ngành:</label>
            <input type="text" name="MaNganh" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
