<?php
include dirname(__DIR__, 3) . '/admincp/config/config.php';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);  // Đảm bảo bảo mật cho tham số query
    $sql = "SELECT donhang.MaDH, khachhang.HoTen AS MaKH 
            FROM donhang 
            JOIN khachhang ON khachhang.MaKH = donhang.MaKH 
            WHERE donhang.MaDH LIKE '%$query%' 
            LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='p-2 cursor-pointer hover:bg-gray-200' onclick='selectOrder(\"{$row['MaDH']}\")'>
                    <b>{$row['MaDH']}</b> - Khách hàng: {$row['MaKH']}
                  </div>";
        }
    } else {
        echo "<div class='p-2'>Không có kết quả tìm kiếm nào.</div>";
    }
}
?>
