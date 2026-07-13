<?php
// Gọi file kết nối CSDL
require 'bai01.php';

// Khởi tạo biến keyword rỗng và mảng students trống
$keyword = '';
$students = [];

// Danh sách cột được phép sắp xếp (tránh SQL injection qua tham số sort)
$allowed_sort_columns = ['name', 'email'];
// Lấy cột sắp xếp từ URL; nếu không hợp lệ thì mặc định là 'id'
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sort_columns) ? $_GET['sort'] : 'id';
// Lấy thứ tự sắp xếp (ASC/DESC); mặc định là ASC
$order = isset($_GET['order']) && strtolower($_GET['order']) === 'desc' ? 'DESC' : 'ASC';

// Xác định thứ tự cho lần click tiếp theo (đảo ngược thứ tự hiện tại)
$next_order = ($order === 'ASC') ? 'desc' : 'asc';

// Nếu có từ khóa tìm kiếm (không rỗng sau khi trim)
if (isset($_GET['keyword']) && trim($_GET['keyword']) !== '') {
    $keyword = trim($_GET['keyword']);

    // Câu SQL tìm kiếm theo tên và sắp xếp
    $sql = "SELECT * FROM students WHERE name LIKE :keyword ORDER BY $sort $order";
    $stmt = $pdo->prepare($sql);

    // Gán giá trị cho tham số keyword (thêm dấu % để tìm kiếm LIKE)
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // Lấy tất cả kết quả
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Nếu không có từ khóa, lấy tất cả sinh viên và sắp xếp
    $sql = "SELECT * FROM students ORDER BY $sort $order";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Form tìm kiếm, giữ lại tham số sort/order nếu có -->
<form method="GET" action="">
    <label>Nhập tên sinh viên: </label>
    <?php if (isset($_GET['sort'])): ?>
        <!-- Trường ẩn giữ lại cột sắp xếp và thứ tự khi tìm kiếm -->
        <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort']) ?>">
        <input type="hidden" name="order" value="<?= htmlspecialchars($_GET['order']) ?>">
    <?php endif; ?>
    <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="Nhập tên cần tìm...">
    <button type="submit">Tìm kiếm</button>
</form>

<!-- Bảng hiển thị danh sách sinh viên với chức năng sắp xếp -->
<table border="1" cellpadding="5">
    <tr>
        <!-- Cột Họ tên - click để sắp xếp, hiển thị mũi tên ▲/▼ nếu đang sắp xếp theo cột này -->
        <th>
            <a href="?sort=name&order=<?= $next_order ?>&keyword=<?= urlencode($keyword) ?>"
                style="text-decoration: none; color: black;">
                Họ và tên
                <?= ($sort === 'name') ? ($order === 'ASC' ? '▲' : '▼') : '' ?>
            </a>
        </th>
        <!-- Cột Email - click để sắp xếp -->
        <th>
            <a href="?sort=email&order=<?= $next_order ?>&keyword=<?= urlencode($keyword) ?>"
                style="text-decoration: none; color: black;">
                Email
                <?= ($sort === 'email') ? ($order === 'ASC' ? '▲' : '▼') : '' ?>
            </a>
        </th>
        <th>Số điện thoại</th>
        <th>Sinh Nhật</th>
    </tr>

    <!-- Nếu có dữ liệu thì duyệt và hiển thị từng dòng -->
    <?php if (!empty($students)): ?>
        <?php foreach ($students as $row): ?>
            <tr>
                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['email']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['phone']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['birthday']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Thông báo khi không tìm thấy kết quả -->
        <tr>
            <td colspan="4" style="text-align: center;">Không tìm thấy sinh viên nào phù hợp.</td>
        </tr>
    <?php endif; ?>
</table>