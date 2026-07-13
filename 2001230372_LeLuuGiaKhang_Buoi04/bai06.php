<?php
// Gọi file kết nối CSDL
require 'bai01.php';

// Nếu có tham số 'id' trên URL -> lấy thông tin sinh viên cần sửa
if (isset($_GET['id'])) {
    // Chuẩn bị câu lệnh SELECT với placeholder
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
    // Thực thi với id từ URL
    $stmt->execute([$_GET['id']]);
    // Lấy một dòng dữ liệu dưới dạng mảng kết hợp
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Nếu form được submit bằng POST -> cập nhật dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Chuẩn bị câu lệnh UPDATE với các placeholder
    $stmt = $pdo->prepare('update students set name=?, email=?, phone=?, birthday=? where id=?');
    // Thực thi cập nhật với dữ liệu từ form
    $stmt->execute([$_POST["name"], $_POST["email"], $_POST["phone"], $_POST["birthday"], $_POST['id'],]);
    // Chuyển hướng về trang danh sách
    header("Location: bai03.php");
    exit;
}
?>

<!-- Form sửa thông tin sinh viên, các input đã được điền sẵn dữ liệu cũ -->
<form method="post">
    <!-- Trường ẩn lưu id sinh viên -->
    <input type="hidden" name="id" value="<?= $student['id'] ?>">
    <label>Họ Tên:</label> <input type="text" name="name" value="<?= $student['name'] ?>">
    <label>Email:</label> <input type="email" name="email" value="<?= $student['email'] ?>">
    <label>SĐT:</label> <input type="text" name="phone" value="<?= $student['phone'] ?>">
    <label>SĐT:</label> <input type="date" name="birthday" value="<?= $student['birthday'] ?>">
    <button type="submit">Sửa</button>
</form>