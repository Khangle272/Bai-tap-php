<?php
// Gọi file kết nối CSDL
require 'bai01.php';

// Lấy từ khóa tìm kiếm từ URL, trim khoảng trắng; mặc định là chuỗi rỗng
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Số bản ghi hiển thị trên mỗi trang
$limit = 5;

// Lấy số trang từ URL; nếu không có hoặc không hợp lệ thì mặc định là trang 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Tính vị trí bắt đầu lấy dữ liệu (offset) cho LIMIT
$offset = ($page - 1) * $limit;

// Câu SQL đếm tổng số bản ghi phù hợp với từ khóa
$sqlCount = "SELECT COUNT(*) FROM students WHERE name LIKE :keyword";

// Chuẩn bị và thực thi câu lệnh đếm
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute([':keyword' => "%$keyword%"]);

// Lấy tổng số bản ghi
$totalRecords = $stmtCount->fetchColumn();

// Tính tổng số trang (làm tròn lên)
$totalPages = ceil($totalRecords / $limit);

// Câu SQL lấy dữ liệu có phân trang, sắp xếp id giảm dần
$sql = "SELECT * FROM students
WHERE name LIKE :keyword
ORDER BY id DESC
LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
// Gán giá trị cho từng tham số với kiểu dữ liệu tương ứng
$stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
// Lấy tất cả kết quả dưới dạng mảng kết hợp
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <!-- Import Bootstrap CSS để làm đẹp giao diện -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
" rel="stylesheet">
</head>

<body class="container mt-4">
    <h2>Danh sách sinh viên</h2>
    <!-- Form tìm kiếm theo tên -->
    <form method="get" class="row mb-3">
        <div class="col-md-4">
            <!-- Ô nhập từ khóa, giữ lại giá trị đã tìm -->
            <input type="text" name="keyword" value="<?=
                htmlspecialchars($keyword) ?>" class="form-control" placeholder="Nhập tên cần tìm">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    <!-- Bảng hiển thị dữ liệu -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Sinh Nhật</th>
            </tr>
        </thead>
        <tbody>
            <!-- Nếu có dữ liệu thì hiển thị từng dòng -->
            <?php if ($students): ?>
                <?php foreach ($students as $index => $row): ?>
                    <tr>
                        <!-- Số thứ tự = offset + vị trí trong trang + 1 -->
                        <td><?= $offset + $index + 1 ?></td>
                        <!-- htmlspecialchars chuyển đổi ký tự đặc biệt để tránh XSS -->
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= $row['birthday'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Nếu không có dữ liệu thì hiển thị thông báo -->
                <tr>
                    <td colspan="5" class="text-center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Phân trang -->
    <nav>
        <ul class="pagination">
            <!-- Nút "Đầu" và "Trước" - chỉ hiện nếu không ở trang 1 -->
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                    urlencode($keyword) ?>&page=1">Đầu</a></li>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                    urlencode($keyword) ?>&page=<?= $page - 1 ?>">Trước</a></li>
            <?php endif; ?>
            <!-- Duyệt và hiển thị từng số trang -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <!-- Trang hiện tại được đánh dấu 'active' -->
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?keyword=<?=
                        urlencode($keyword) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <!-- Nút "Sau" và "Cuối" - chỉ hiện nếu không ở trang cuối -->
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                    urlencode($keyword) ?>&page=<?= $page + 1 ?>">Sau</a></li>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                    urlencode($keyword) ?>&page=<?= $totalPages ?>">Cuối</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>