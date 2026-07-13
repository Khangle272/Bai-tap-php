<?php
// Gọi file kết nối CSDL
require 'bai01.php';

// Kiểm tra nếu có tham số 'id' trên URL
if (isset($_GET['id'])) {
    // Chuẩn bị câu lệnh DELETE với placeholder để tránh SQL injection
    $stmt = $pdo->prepare('delete from students where id = ?');
    // Thực thi xóa sinh viên có id tương ứng
    $stmt->execute([$_GET['id']]);
}

// Sau khi xóa, chuyển hướng về trang danh sách (bai03.php)
header('Location: bai03.php');
// Dừng script để đảm bảo chuyển hướng được thực hiện
exit;
?>