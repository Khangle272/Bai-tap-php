<?php
// Gọi file kết nối CSDL để có biến $pdo
require 'bai01.php';

// Thực thi truy vấn lấy toàn bộ dữ liệu từ bảng students
$stmt = $pdo->query("select * from students");
// Lấy tất cả các dòng kết quả dưới dạng mảng kết hợp (Assoc)
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Bảng HTML hiển thị danh sách sinh viên -->
<table border="1" cellpadding="5">
    <tr>
        <!-- Tiêu đề các cột -->
        <th>ID</th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Sinh Nhật</th>
    </tr>
    <!-- Duyệt từng sinh viên trong mảng $students -->
    <?php foreach ($students as $student): ?>
        <tr>
            <!-- Xuất giá trị từng cột của sinh viên -->
            <td><?= $student['id'] ?></td>
            <td><?= $student['name'] ?></td>
            <td><?= $student['email'] ?></td>
            <td><?= $student['phone'] ?></td>
            <td><?= $student['birthday'] ?></td>
            <!-- Link xóa: chuyển đến bai05.php kèm id, có hộp thoại xác nhận -->
            <td><a href="bai05.php?id=<?= $student['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a></td>
            <!-- Link sửa: chuyển đến bai06.php kèm id -->
            <td><a href="bai06.php?id=<?= $student['id'] ?>">Sửa</a></td>
        </tr>
    <?php endforeach; ?>
</table>