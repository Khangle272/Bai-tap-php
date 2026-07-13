<!-- Form nhập liệu thêm sinh viên mới, gửi bằng phương thức POST -->
<form method="post">
    <label>Họ Tên:</label> <input type="text" name="name" required> <br>
    <label>Email:</label> <input type="email" name="email" required> <br>
    <label>SĐT:</label> <input type="text" name="phone"> <br>
    <label>Sinh Nhật:</label> <input type="date" name="birthday"> <br>
    <button type="submit">Thêm</button>
</form>

<?php
// Gọi file kết nối CSDL
require 'bai01.php';

// Kiểm tra nếu form được submit bằng phương thức POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Chuẩn bị câu lệnh INSERT với placeholder (?) để tránh SQL injection
    $stmt = $pdo->prepare("insert into students (name, email, phone, birthday) values (?, ?, ?, ?)");
    // Thực thi câu lệnh với dữ liệu lấy từ form
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['birthday']]);
    // Thông báo thêm thành công
    echo "Thêm thành công";
}
?>