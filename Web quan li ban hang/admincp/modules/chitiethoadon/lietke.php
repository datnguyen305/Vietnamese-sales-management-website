<?php
// Kết nối cơ sở dữ liệu
include dirname(__DIR__, 3) . '/admincp/config/config.php';

// Số sản phẩm trên mỗi trang
$so_san_pham_moi_tren_trang = 10;

// Lấy giá trị tìm kiếm (nếu có)
$search_ma_dh = isset($_GET['search_ma_dh']) ? mysqli_real_escape_string($conn, $_GET['search_ma_dh']) : '';
$search_ma_sp = isset($_GET['search_ma_sp']) ? mysqli_real_escape_string($conn, $_GET['search_ma_sp']) : '';
$search_soluong = isset($_GET['search_soluong']) ? mysqli_real_escape_string($conn, $_GET['search_soluong']) : '';
$search_thanhtien = isset($_GET['search_thanhtien']) ? mysqli_real_escape_string($conn, $_GET['search_thanhtien']) : '';

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $so_san_pham_moi_tren_trang;

// Câu truy vấn lấy chi tiết hóa đơn với tìm kiếm
$sql_lietke_cthd = "SELECT * FROM chitietdonhang WHERE 1";

if ($search_ma_dh) {
    $sql_lietke_cthd .= " AND MaDH LIKE '%$search_ma_dh%'";
}

if ($search_ma_sp) {
    $sql_lietke_cthd .= " AND MaSP LIKE '%$search_ma_sp%'";
}

if ($search_soluong) {
    $sql_lietke_cthd .= " AND SoLuong LIKE '%$search_soluong%'";
}

if ($search_thanhtien) {
    $sql_lietke_cthd .= " AND ThanhTien LIKE '%$search_thanhtien%'";
}

$sql_lietke_cthd .= " ORDER BY MaCTDH DESC LIMIT $start_from, $so_san_pham_moi_tren_trang";
$query_lietke_cthd = mysqli_query($conn, $sql_lietke_cthd);

// Lấy tổng số sản phẩm để tính số trang
$sql_total = "SELECT COUNT(*) FROM chitietdonhang WHERE 1";
if ($search_ma_dh) {
    $sql_total .= " AND MaDH LIKE '%$search_ma_dh%'";
}
if ($search_ma_sp) {
    $sql_total .= " AND MaSP LIKE '%$search_ma_sp%'";
}
if ($search_soluong) {
    $sql_total .= " AND SoLuong LIKE '%$search_soluong%'";
}
if ($search_thanhtien) {
    $sql_total .= " AND ThanhTien LIKE '%$search_thanhtien%'";
}

$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_array($query_total);
$total_records = $row_total[0];
$total_pages = ceil($total_records / $so_san_pham_moi_tren_trang);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 mt-4">Liệt kê chi tiết hóa đơn</p>

<!-- Thanh tìm kiếm với nhiều bộ lọc -->
<form method="GET" class="mb-4 flex gap-4">
    <input type="hidden" name="action" value="quanlihoadon">
    <input type="hidden" name="query" value="lietke">

    <!-- Tìm kiếm theo mã đơn hàng -->
    <input type="text" name="search_ma_dh" placeholder="Tìm theo mã đơn hàng" value="<?php echo htmlspecialchars($search_ma_dh); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Tìm kiếm theo mã sản phẩm -->
    <input type="text" name="search_ma_sp" placeholder="Tìm theo mã sản phẩm" value="<?php echo htmlspecialchars($search_ma_sp); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Tìm kiếm theo số lượng -->
    <input type="text" name="search_soluong" placeholder="Tìm theo số lượng" value="<?php echo htmlspecialchars($search_soluong); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Tìm kiếm theo thành tiền -->
    <input type="text" name="search_thanhtien" placeholder="Tìm theo thành tiền" value="<?php echo htmlspecialchars($search_thanhtien); ?>" class="border border-gray-300 rounded-md p-2">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tìm kiếm</button>
</form>

<div class="overflow-x-auto">
    <table class="product-table table-auto min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Mã chi tiết hóa đơn</th>
                <th class="px-4 py-2 border">Mã đơn hàng</th>
                <th class="px-4 py-2 border">Mã sản phẩm</th>
                <th class="px-4 py-2 border">Số lượng</th>
                <th class="px-4 py-2 border">Thành tiền</th>
                <th class="px-4 py-2 border">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($query_lietke_cthd) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query_lietke_cthd)) { ?>
                    <tr>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaCTDH']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaDH']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaSP']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['SoLuong']); ?></td>
                        <td class="px-4 py-2 border"><?php echo number_format($row['ThanhTien'], 0, ',', '.'); ?> VND</td>
                        <td class="px-4 py-2 border">
                            <a href="modules/chitiethoadon/xuli.php?MaDH=<?php echo $row['MaDH'] ?>&MaSP=<?php echo $row['MaSP'] ?>&MaCTDH=<?php echo $row['MaCTDH'] ?>" class="text-blue-500 hover:underline">Xóa</a> |
                            <a href="?action=chitiethoadon&query=sua&MaDH=<?php echo $row['MaDH'] ?>&MaSP=<?php echo $row['MaSP'] ?>&MaCTDH=<?php echo $row['MaCTDH'] ?>" class="text-blue-500 hover:underline">Sửa</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center p-4 text-gray-500">Không tìm thấy hóa đơn nào!</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Phân trang -->
<div class="pagination mt-4 border border-gray-300 p-2 rounded-lg flex gap-2 justify-center">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?action=quanlihoadon&query=lietke&page=<?php echo $i; ?>&search_ma_dh=<?php echo urlencode($search_ma_dh); ?>&search_ma_sp=<?php echo urlencode($search_ma_sp); ?>&search_soluong=<?php echo urlencode($search_soluong); ?>&search_thanhtien=<?php echo urlencode($search_thanhtien); ?>"
           class="pagination-link px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-200 transition <?php echo ($i == $page) ? 'bg-blue-500 text-white' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>
</div>
