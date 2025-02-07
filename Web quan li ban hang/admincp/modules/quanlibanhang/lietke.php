<?php
// Kết nối cơ sở dữ liệu
include dirname(__DIR__, 3) . '/admincp/config/config.php';

// Số sản phẩm trên mỗi trang
$so_san_pham_moi_tren_trang = 10;

// Lấy giá trị tìm kiếm (nếu có)
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $so_san_pham_moi_tren_trang;

// Lọc theo ngày đăng và giá
$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;

// Câu truy vấn lấy sản phẩm với tìm kiếm và bộ lọc
$sql_lietke_sp = "SELECT * FROM sanpham WHERE 1";

if ($search) {
    $sql_lietke_sp .= " AND TenSP LIKE '%$search%'";
}

if ($filter_date) {
    $sql_lietke_sp .= " AND NgayNhap >= '$filter_date'";
}

if ($min_price) {
    $sql_lietke_sp .= " AND DonGia >= $min_price";
}

if ($max_price) {
    $sql_lietke_sp .= " AND DonGia <= $max_price";
}

$sql_lietke_sp .= " ORDER BY MaSP DESC LIMIT $start_from, $so_san_pham_moi_tren_trang";
$query_lietke_sp = mysqli_query($conn, $sql_lietke_sp);

// Lấy tổng số sản phẩm để tính số trang
$sql_total = "SELECT COUNT(*) FROM sanpham WHERE 1";
if ($search) {
    $sql_total .= " AND TenSP LIKE '%$search%'";
}
if ($filter_date) {
    $sql_total .= " AND NgayNhap >= '$filter_date'";
}
if ($min_price) {
    $sql_total .= " AND DonGia >= $min_price";
}
if ($max_price) {
    $sql_total .= " AND DonGia <= $max_price";
}
$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_array($query_total);
$total_records = $row_total[0];
$total_pages = ceil($total_records / $so_san_pham_moi_tren_trang);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 mt-4">Liệt kê 10 sản phẩm mới nhất</p>

<!-- Thanh tìm kiếm và bộ lọc -->
<form method="GET" class="mb-4 flex gap-4">
    <input type="hidden" name="action" value="quanlisanpham">
    <input type="hidden" name="query" value="lietke">

    <!-- Tìm kiếm theo tên sản phẩm -->
    <input type="text" name="search" placeholder="Tìm theo tên sản phẩm" value="<?php echo htmlspecialchars($search); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Bộ lọc theo ngày -->
    <input type="date" name="filter_date" value="<?php echo isset($_GET['filter_date']) ? htmlspecialchars($_GET['filter_date']) : ''; ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Bộ lọc theo giá -->
    <input type="number" name="min_price" placeholder="Giá từ" value="<?php echo isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : ''; ?>" class="border border-gray-300 rounded-md p-2" step="1000">
    <input type="number" name="max_price" placeholder="Giá đến" value="<?php echo isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : ''; ?>" class="border border-gray-300 rounded-md p-2" step="1000">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tìm kiếm</button>
</form>

<div class="overflow-x-auto">
    <table class="product-table table-auto min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">MaSP</th>
                <th class="px-4 py-2 border">Tên sản phẩm</th>
                <th class="px-4 py-2 border">Đơn giá</th>
                <th class="px-4 py-2 border">Giảm giá</th>
                <th class="px-4 py-2 border">Số lượng tồn</th>
                <th class="px-4 py-2 border">Giá gốc</th>
                <th class="px-4 py-2 border">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query_lietke_sp)) { ?>
                <tr>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaSP']); ?></td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['TenSP']); ?></td>
                    <td class="px-4 py-2 border"><?php echo number_format($row['DonGia'], 0, ',', '.'); ?> VND</td>
                    <td class="px-4 py-2 border"><?php echo number_format($row['GiamGia'], 0, ',', '.'); ?> %</td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['SoLuongTon']); ?></td>
                    <td class="px-4 py-2 border"><?php echo number_format($row['GIAGOC'], 0, ',', '.'); ?> VND</td>
                    <td class="px-4 py-2 border">
                        <a href="modules/quanlibanhang/xuli.php?MaSP=<?php echo $row['MaSP'] ?>" class="text-blue-500 hover:underline">Xóa</a> |
                        <a href="?action=quanlisanpham&query=sua&MaSP=<?php echo $row['MaSP'] ?>" class="text-blue-500 hover:underline">Sửa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Phân trang -->
<div class="pagination mt-4 border border-gray-300 p-2 rounded-lg flex gap-2 justify-center">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?action=quanlisanpham&query=lietke&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&filter_date=<?php echo urlencode($filter_date); ?>&min_price=<?php echo urlencode($min_price); ?>&max_price=<?php echo urlencode($max_price); ?>"
           class="pagination-link px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-200 transition <?php echo ($i == $page) ? 'bg-blue-500 text-white' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>
</div>
