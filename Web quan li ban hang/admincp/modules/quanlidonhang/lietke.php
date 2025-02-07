<?php
// Kết nối cơ sở dữ liệu
include dirname(__DIR__, 3) . '/admincp/config/config.php';

// Số đơn hàng trên mỗi trang
$so_don_hang_moi_tren_trang = 10;

// Lấy giá trị tìm kiếm (nếu có)
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Lọc theo ngày và trạng thái
$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
$filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $so_don_hang_moi_tren_trang;

// Câu truy vấn lấy đơn hàng với tìm kiếm và bộ lọc
$sql_lietke_dh = "SELECT * FROM donhang WHERE 1";

if ($search) {
    $sql_lietke_dh .= " AND MaKH LIKE '%$search%'";
}

if ($filter_date) {
    $sql_lietke_dh .= " AND NgayLap >= '$filter_date'";
}

if ($filter_status) {
    $sql_lietke_dh .= " AND TrangThai = '$filter_status'";
}

$sql_lietke_dh .= " ORDER BY MaDH DESC LIMIT $start_from, $so_don_hang_moi_tren_trang";
$query_lietke_dh = mysqli_query($conn, $sql_lietke_dh);

// Lấy tổng số đơn hàng để tính số trang
$sql_total = "SELECT COUNT(*) FROM donhang WHERE 1";
if ($search) {
    $sql_total .= " AND MaKH LIKE '%$search%'";
}
if ($filter_date) {
    $sql_total .= " AND NgayLap >= '$filter_date'";
}
if ($filter_status) {
    $sql_total .= " AND TrangThai = '$filter_status'";
}
$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_array($query_total);
$total_records = $row_total[0];
$total_pages = ceil($total_records / $so_don_hang_moi_tren_trang);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 mt-4">Liệt kê đơn hàng mới</p>

<!-- Thanh tìm kiếm và bộ lọc -->
<form method="GET" class="mb-4 flex gap-4">
    <input type="hidden" name="action" value="quanlidonhang">
    <input type="hidden" name="query" value="lietke">

    <!-- Tìm kiếm theo mã khách hàng -->
    <input type="text" name="search" placeholder="Tìm theo mã khách hàng" value="<?php echo htmlspecialchars($search); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Bộ lọc theo ngày lập -->
    <input type="date" name="filter_date" value="<?php echo isset($_GET['filter_date']) ? htmlspecialchars($_GET['filter_date']) : ''; ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Bộ lọc theo trạng thái -->
    <select name="filter_status" class="border border-gray-300 rounded-md p-2">
        <option value="">Chọn trạng thái</option>
        <option value="Đang xử lý" <?php echo ($filter_status == 'Đang xử lý') ? 'selected' : ''; ?>>Đang xử lý</option>
        <option value="Đã giao" <?php echo ($filter_status == 'Đã giao') ? 'selected' : ''; ?>>Đã giao</option>
        <option value="Đã hủy" <?php echo ($filter_status == 'Đã hủy') ? 'selected' : ''; ?>>Đã hủy</option>
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tìm kiếm</button>
</form>

<div class="overflow-x-auto">
    <table class="product-table table-auto min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Mã đơn hàng</th>
                <th class="px-4 py-2 border">Mã khách hàng</th>
                <th class="px-4 py-2 border">Ngày lập</th>
                <th class="px-4 py-2 border">Tổng tiền</th>
                <th class="px-4 py-2 border">Trạng thái</th>
                <th class="px-4 py-2 border">Tiền đã thanh toán</th>
                <th class="px-4 py-2 border">Thao tác</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($row = mysqli_fetch_assoc($query_lietke_dh)) { ?>
                    <tr>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaDH']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaKH']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['NgayLap']); ?></td>
                        <td class="px-4 py-2 border"><?php echo number_format($row['TongTien'], 0, ',', '.'); ?> VND</td>
                        <?php
// Mảng ánh xạ trạng thái
$trangthai_map = [
    "Dang no" => "Đang nợ",
    "Da Thanh Toan" => "Đã thanh toán",
];

// Lấy trạng thái từ cơ sở dữ liệu
$trangthai_goc = $row['TrangThai'];
$trangthai_hienthi = isset($trangthai_map[$trangthai_goc]) ? $trangthai_map[$trangthai_goc] : "Không xác định";
?>
<td class="px-4 py-2 border"><?php echo htmlspecialchars($trangthai_hienthi); ?></td>
                        <td class="px-4 py-2 border"><?php echo number_format($row['TienDaThanhToan'], 0, ',', '.'); ?> VND</td>
                        <td class="px-4 py-2 border">
                            <a href="modules/quanlidonhang/xuli.php?MaDH=<?php echo $row['MaDH'] . '&MaKH=' . $row['MaKH']; ?>" class="text-blue-500 hover:underline">Xóa</a> |
                            <a href="?action=quanlidonhang&query=sua&MaDH=<?php echo urlencode($row['MaDH']) . '&MaKH=' . urlencode($row['MaKH']); ?>" class="text-blue-500 hover:underline">Sửa</a>
                        </td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<!-- Phân trang -->
<div class="pagination mt-4 border border-gray-300 p-2 rounded-lg flex gap-2 justify-center">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?action=quanlidonhang&query=lietke&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&filter_date=<?php echo urlencode($filter_date); ?>&filter_status=<?php echo urlencode($filter_status); ?>"
           class="pagination-link px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-200 transition <?php echo ($i == $page) ? 'bg-blue-500 text-white' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>
</div>
