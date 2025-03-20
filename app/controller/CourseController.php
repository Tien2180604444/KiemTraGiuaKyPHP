    <?php
    require_once '../../config/database.php';
    require_once '../../models/Course.php';

    class CourseController {
        private $courseModel;

        public function __construct($conn) {
            $this->courseModel = new Course($conn);
        }

        // Lấy tất cả học phần
        public function index() {
            $courses = $this->courseModel->getAllCourses();
            include '../../views/courses/list.php'; // Gọi giao diện hiển thị danh sách học phần
        }

        // Lấy thông tin chi tiết 1 học phần
        public function show($id) {
            $course = $this->courseModel->getCourseById($id);
            if (!$course) {
                die("Không tìm thấy học phần!");
            }
            include '../../views/courses/detail.php'; // Gọi giao diện hiển thị chi tiết học phần
        }

        // Thêm mới học phần
        public function store($data) {
            $maHP = $data['MaHP'];
            $tenHP = $data['TenHP'];
            $soTinChi = $data['SoTinChi'];

            $query = "INSERT INTO hocphan (MaHP, TenHP, SoTinChi) VALUES (:MaHP, :TenHP, :SoTinChi)";
            $stmt = $this->courseModel->$conn->prepare($query);
            $stmt->bindParam(":MaHP", $maHP);
            $stmt->bindParam(":TenHP", $tenHP);
            $stmt->bindParam(":SoTinChi", $soTinChi);

            if ($stmt->execute()) {
                header("Location: list.php");
                exit();
            } else {
                echo "Lỗi khi thêm học phần!";
            }
        }

        // Cập nhật học phần
        public function update($id, $data) {
            $maHP = $data['MaHP'];
            $tenHP = $data['TenHP'];
            $soTinChi = $data['SoTinChi'];

            $query = "UPDATE hocphan SET TenHP = :TenHP, SoTinChi = :SoTinChi WHERE MaHP = :MaHP";
            $stmt = $this->courseModel->conn->prepare($query);
            $stmt->bindParam(":MaHP", $maHP);
            $stmt->bindParam(":TenHP", $tenHP);
            $stmt->bindParam(":SoTinChi", $soTinChi);

            if ($stmt->execute()) {
                header("Location: list.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật học phần!";
            }
        }

        // Xóa học phần
        public function destroy($id) {
            $query = "DELETE FROM hocphan WHERE MaHP = :MaHP";
            $stmt = $this->courseModel->conn->prepare($query);
            $stmt->bindParam(":MaHP", $id);

            if ($stmt->execute()) {
                header("Location: list.php");
                exit();
            } else {
                echo "Lỗi khi xóa học phần!";
            }
        }
    }

    // Xử lý yêu cầu từ form hoặc URL
    $controller = new CourseController($conn);
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';

    switch ($action) {
        case 'index':
            $controller->index();
            break;
        case 'show':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->show($id);
            }
            break;
        case 'store':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store($_POST);
            }
            break;
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['MaHP'];
                $controller->update($id, $_POST);
            }
            break;
        case 'destroy':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->destroy($id);
            }
            break;
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
    ?>
