<?php
// Kết nối cơ sở dữ liệu
include dirname(__DIR__, 3) . '/admincp/config/config.php';

// Số lịch sử thanh toán trên mỗi trang
$so_ban_ghi_moi_tren_trang = 10;

// Lấy giá trị tìm kiếm (nếu có)
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $so_ban_ghi_moi_tren_trang;

// Câu truy vấn lấy lịch sử thanh toán với tìm kiếm
$sql_lietke_lstt = "SELECT * FROM lichsuthanhtoan WHERE 1";

if ($search) {
    $sql_lietke_lstt .= " AND MaKH LIKE '%$search%'";
}

$sql_lietke_lstt .= " ORDER BY MaLSTT DESC LIMIT $start_from, $so_ban_ghi_moi_tren_trang";
$query_lietke_lstt = mysqli_query($conn, $sql_lietke_lstt);

// Lấy tổng số bản ghi để tính số trang
$sql_total = "SELECT COUNT(*) FROM lichsuthanhtoan WHERE 1";
if ($search) {
    $sql_total .= " AND MaKH LIKE '%$search%'";
}
$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_array($query_total);
$total_records = $row_total[0];
$total_pages = ceil($total_records / $so_ban_ghi_moi_tren_trang);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 mt-4">Lịch sử thanh toán</p>

<!-- Thanh tìm kiếm -->
<form method="GET" class="mb-4 flex gap-4">
    <input type="hidden" name="action" value="lichsuthanhtoan">
    <input type="hidden" name="query" value="lietke">
    <input type="text" name="search" placeholder="Tìm theo mã khách hàng" value="<?php echo htmlspecialchars($search); ?>" class="border border-gray-300 rounded-md p-2">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tìm kiếm</button>
</form>

<div class="overflow-x-auto">
    <table class="product-table table-auto min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Mã lịch sử thanh toán</th>
                <th class="px-4 py-2 border">Mã đơn hàng</th>
                <th class="px-4 py-2 border">Mã khách hàng</th>
                <th class="px-4 py-2 border">Ngày thanh toán</th>
                <th class="px-4 py-2 border">Số tiền thanh toán</th>
                <th class="px-4 py-2 border">Thao tác</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($row = mysqli_fetch_assoc($query_lietke_lstt)) { ?>
                    <tr>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaLSTT']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaDH']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaKH']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['NgayThanhToan']); ?></td>
                        <td class="px-4 py-2 border"><?php echo number_format($row['SoTienThanhToan'], 0, ',', '.'); ?> VND</td>
                        <td class="px-4 py-2 border">
                            <a href="modules/lichsuthanhtoan/xuli.php?MaLSTT=<?php echo $row['MaLSTT']; ?>" class="text-blue-500 hover:underline">Xóa</a> |
                            <a href="?action=lichsuthanhtoan&query=sua&MaLSTT=<?php echo urlencode($row['MaLSTT']); ?>" class="text-blue-500 hover:underline">Sửa</a>
                        </td>   
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<!-- Phân trang -->
<div class="pagination mt-4 border border-gray-300 p-2 rounded-lg flex gap-2 justify-center">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?action=lichsuthanhtoan&query=lietke&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
           class="pagination-link px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-200 transition <?php echo ($i == $page) ? 'bg-blue-500 text-white' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>
</div>
