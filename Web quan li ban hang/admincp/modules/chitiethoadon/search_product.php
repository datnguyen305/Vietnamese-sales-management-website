<?php
include dirname(__DIR__, 3) . '/admincp/config/config.php';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT MaSP, TenSP FROM sanpham WHERE MaSP LIKE '%$query%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='p-2 cursor-pointer hover:bg-gray-200' onclick='selectProduct(\"{$row['MaSP']}\")'>
                    <b>{$row['MaSP']}</b> - Tên sản phẩm: {$row['TenSP']}
                  </div>";
        }
    } else {
        echo "<div class='p-2'>Không có kết quả tìm kiếm nào.</div>";
    }
}
?>
