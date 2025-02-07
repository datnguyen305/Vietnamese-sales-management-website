<?php
// Kết nối cơ sở dữ liệu
include dirname(__DIR__, 3) . '/admincp/config/config.php';

// Kiểm tra xem có tham số 'query' trong URL không
if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']); // Lọc và bảo mật dữ liệu nhập vào

    // Truy vấn tìm kiếm khách hàng theo mã khách hàng hoặc tên khách hàng
    $sql = "SELECT MaKH, HoTen FROM khachhang WHERE MaKH LIKE '%$query%' OR HoTen LIKE '%$query%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    // Duyệt qua kết quả và trả về danh sách gợi ý
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='p-2 cursor-pointer hover:bg-gray-200' onclick='selectCustomer(\"{$row['MaKH']}\")'>
                <b>{$row['MaKH']}</b> - {$row['HoTen']}
              </div>";
    }
}
?>
