<?php
// Chuỗi kết nối CSDL: chỉ định host, tên database, charset UTF8
$dsn = "mysql:host=localhost;dbname=labdb;charset=utf8";
// Tên đăng nhập MySQL
$username = "root";
// Mật khẩu MySQL (để trống)
$password = "";

try {
    // Tạo đối tượng PDO kết nối đến MySQL
    $pdo = new PDO($dsn, $username, $password);
    // Cấu hình PDO báo lỗi dưới dạng ngoại lệ (Exception)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Thông báo kết nối thành công
    echo "Kết nối thành công <br>";
} catch (Exception $e) {
    // Bắt lỗi nếu kết nối thất bại và hiển thị thông báo lỗi
    echo "Kết nối thất bại" . $e->getMessage();
}
?>