<?php
// Mở đầu thẻ PHP, yêu cầu PHP xử lý code bên trong
require 'bai01.php';

// Khởi tạo biến $keyword rỗng, dùng để lưu từ khóa tìm kiếm
$keyword = '';
// Khởi tạo mảng $students rỗng, dùng để lưu danh sách sinh viên
$students = [];

// Kiểm tra nếu có tham số 'keyword' được gửi qua URL (method GET)
if (isset($_GET['keyword'])) {
    // trim(): loại bỏ khoảng trắng thừa ở đầu và cuối chuỗi nhập vào
    $keyword = trim($_GET['keyword']);

    // Câu truy vấn SQL: tìm sinh viên có tên chứa từ khóa (LIKE)
    $sql = 'select * from students where name like :keyword';
    // prepare(): tạo prepared statement để tránh SQL injection
    $stmt = $pdo->prepare($sql);

    // bindValue(): gán giá trị cho tham số :keyword, thêm dấu % để tìm kiếm LIKE
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    // execute(): thực thi câu truy vấn đã chuẩn bị
    $stmt->execute();

    // fetchAll(): lấy tất cả kết quả dưới dạng mảng kết hợp (FETCH_ASSOC)
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Nếu không có từ khóa, lấy tất cả sinh viên từ bảng students
    $stmt = $pdo->query("select * from students");
    // fetchAll(): lấy toàn bộ kết quả dưới dạng mảng kết hợp
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Kết thúc thẻ PHP, chuyển sang hiển thị HTML
?>

<!-- Form tìm kiếm, gửi dữ liệu bằng phương thức GET đến chính trang hiện tại (action rỗng) -->
<form method="GET" action="">
    <!-- Nhãn ô nhập liệu -->
    <label>Nhập tên sinh viên: </label>
    <!-- Ô nhập text, name="keyword", value giữ lại từ khóa đã nhập, htmlspecialchars() chống XSS -->
    <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="Nhập tên cần tìm...">
    <!-- Nút submit gửi form -->
    <button type="submit">Tìm kiếm</button>
</form>

<!-- Bảng hiển thị danh sách sinh viên, viền 1px, cellpadding 5px -->
<table border="1" cellpadding="5">
    <!-- Dòng tiêu đề bảng -->
    <tr>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Sinh Nhật</th>
    </tr>

    <!-- Kiểm tra nếu mảng $students không rỗng thì hiển thị dữ liệu -->
    <?php if (!empty($students)): ?>
        <!-- foreach: lặp qua từng sinh viên trong mảng $students, mỗi phần tử gán vào $row -->
        <?php foreach ($students as $row): ?>
            <tr>
                <td>
                    <!-- = là echo, htmlspecialchars() chuyển ký tự đặc biệt thành HTML entities để an toàn khi hiển thị -->
                    <?= htmlspecialchars($row['name']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['email']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['phone']) ?>
                </td>
                <td>
                    <!-- Hiển thị ngày sinh, không dùng htmlspecialchars (dữ liệu ngày không chứa ký tự đặc biệt) -->
                    <?= ($row['birthday']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Trường hợp không có sinh viên nào, hiển thị dòng thông báo -->
        <tr>
            <!-- colspan="4": trải dài qua 4 cột, căn giữa văn bản -->
            <td colspan="4" style="text-align: center;">Không tìm thấy sinh viên nào phù hợp.</td>
        </tr>
    <?php endif; ?>
    <!-- Kết thúc thẻ PHP -->
</table>